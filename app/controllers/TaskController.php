<?php

namespace App\controllers;

use App\models\Task;
use App\models\User;

class TaskController extends BaseController
{
    public function showAction()
    {
        $model = new Task();
        $task = $model->getTask($this->route['id']);
        if($task === false) {
            throw new \Exception('Страница не найдена', 404);
        }

        $this->setMeta('Задача №' . $task->id);
        $this->set(compact('task'));
    }

    public function createAction()
    {
        $this->setMeta('Создать задачу');
    }

    public function storeAction()
    {
        if(!empty($_POST)) {
            $model = new Task();
            $dataTask = $_POST;
            unset($dataTask['status']);
            $model->load($dataTask);

            if(!$model->validate($dataTask)) {
                $model->getErrors();
                $_SESSION['form_data'] = $dataTask;
                $this->redirect();
            }
            $model->save('tasks');
        }

        $this->redirect('/');
    }

    public function editAction()
    {
        if(!User::checkAuth()) {
            throw new \Exception('Доступ запрещен', 403);
        }

        $model = new Task();
        $task = $model->getTask($this->route['id']);
        if($task === false) {
            throw new \Exception('Страница не найдена', 404);
        }
        $this->setMeta('Изменить задачу');
        $this->set(compact('task'));
    }

    public function updateAction()
    {
        if(!User::checkAuth()) {
            throw new \Exception('Доступ запрещен', 403);
        }

        if(!empty($_POST)) {
            $model = new Task();
            $task = $model->getTask($this->route['id']);
            $dataTask = $_POST;
            $dataTask['name'] = $task->name;
            $dataTask['email'] = $task->email;
            $model->load($dataTask);

            if(!$model->validate($dataTask)) {
                $model->getErrors();
                $this->redirect();
            }
            $model->update('tasks', (int)$this->route['id']);
        }

        $this->redirect('/');
    }
}