<?php


class IndexController
{
//отображение стартовой страницы
    public function index()
    {
        //получаем список всех задач
        $tasks = Task::getAllTasks();

        //выводим view
        require_once(ROOT . '/views/index.php');
        return true;
    }

// показываем 404
    public function showErrorPage404()
    {
        //выводим view
        require_once(ROOT . '/views/errors/404.php');
        return true;
    }
}
