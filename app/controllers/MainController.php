<?php

namespace App\controllers;


use App\models\Main;
use Todo\base\Pagination;

class MainController extends BaseController
{
    public function indexAction()
    {
        $filter = $this->queryFilter();
        $model = new Main();
        $tasksCount = $model->getCount();
        $pagination = new Pagination($tasksCount, 3);
        $tasks = $model->getAll($pagination, $filter);
        $this->setMeta('Список задач');
        $this->set(compact('tasks', 'pagination'));
    }
}