<?php



class IndexController
{
//отображение стартовой страницы
    function index()
    {
        //получаем список всех задач
        $tasks = Task::getAllTasks();
        
        //выводим view
        require_once(ROOT . '/views/index.php');
        return true;
    }
}