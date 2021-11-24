<?php

namespace Todo;

use \PDO;
use \PDOException;

class Db
{
    use TSingleton;

    private PDO $pdo;

    protected function __construct()
    {
        $settings = $this->getPDOSettings();
        try {
            $this->pdo = new PDO($settings['dsn'], $settings['user'], $settings['pass'], null);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    protected function getPDOSettings() : array
    {

        $config = include ROOT.'/config/'.'db.php';
        $result['dsn'] = "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        $result['user'] = $config['user'];
        $result['pass'] = $config['pass'];
        return $result;
    }

    public function execute(string $query, ?array $params = null) : array
    {
        if(is_null($params)){
            $stmt = $this->pdo->query($query);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public function save(string $query, array $params) : int
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $this->pdo->lastInsertId();
    }
}