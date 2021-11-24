<?php

namespace App\models;

use Todo\base\Pagination;

class Main extends BaseModel
{
    protected static array $dirs = ['asc', 'desc'];
    protected static array $sort = ['name', 'email', 'status'];

    public function getAll(Pagination $pagination, array $filter = []) : array
    {

        $dir = $this->validateSort('dir', $filter['dir']) ? strtoupper($filter['dir']) : 'DESC';
        $sort = $this->validateSort('sort', $filter['sort']) ? $filter['sort'] : 'id';

        return $this->db->execute(
            "SELECT * FROM tasks ORDER BY {$sort} {$dir} LIMIT {$pagination->getStart()}, {$pagination->perpage}"
        );
    }

    public function getCount() : int
    {
        $query = $this->db->execute("SELECT COUNT(*) AS count FROM tasks");
        return reset($query)->count;
    }

    protected function validateSort($param, $filter) : bool
    {
        if($param === 'dir') {
            return in_array($filter, self::$dirs);
        } else if($param === 'sort') {
            return in_array($filter, self::$sort);
        }
        return false;
    }
}