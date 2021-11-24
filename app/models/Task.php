<?php

namespace App\models;

class Task extends BaseModel
{
    public array $attributes = [
        'name' => '',
        'email' => '',
        'task' => '',
        'status' => 0
    ];

    public array $rules = [
        'required' => [
            ['name'],
            ['email'],
            ['task']
        ],
        'integer' => [
            ['status']
        ]
    ];

    public function getTask($id)
    {
        $query = $this->db->execute(
            "SELECT * FROM tasks WHERE id=? LIMIT 1", [$id]
        );
        return reset($query);
    }
}