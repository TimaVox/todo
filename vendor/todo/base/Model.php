<?php

namespace Todo\base;

use Todo\Db;
use Valitron\Validator;

class Model
{
    public array $attributes = [];
    public array $errors = [];
    public array $rules = [];
    protected Db $db;

    public function __construct()
    {
        $this->db = Db::instance();
    }

    public function load($data){
        foreach($this->attributes as $name => $value){
            if(isset($data[$name])){
                $this->attributes[$name] = htmlspecialchars($data[$name]);
            }
        }
    }

    public function save($table){
        $keyAttributes = array_keys($this->attributes);
        $keys = implode(', ', $keyAttributes);
        $binds = implode(',', array_fill(0, count($keyAttributes), '?'));
        $query = "INSERT INTO `{$table}` ({$keys}) 
            VALUES ({$binds})";

        return $this->db->save($query, array_values($this->attributes));
    }

    public function update($table, $id){
        $keyAttributes = array_keys($this->attributes);
        $binds = implode('=?, ', $keyAttributes);
        $query = "UPDATE `{$table}` SET {$binds}=? WHERE id=?";
        $params = array_values($this->attributes);
        array_push($params, $id);

        return $this->db->save($query,  $params);
    }

    public function validate($data){
//        Validator::langDir(ROOT . '/vendor/vlucas/valitron/lang');
        Validator::lang('ru');
        $v = new Validator($data);
        $v->rules($this->rules);
        if($v->validate()){
            return true;
        }
        $this->errors = $v->errors();
        return false;
    }

    public function getErrors(){
        $_SESSION['errors'] = $this->errors;
    }
}