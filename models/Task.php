<?php

/**
 * Модель для работы с таблицей tasks
 */
class Task
{
    /**
     * получаем список всех задач
     * выбираем по параметрам сортировки. по умолчанию по id DESC
     * @return array возвращаем в виде ассоциативного массива 
     */
    public static function getAllTasks(){
        $tasks = [];
        $db = Db::getConnection();
        //>  --- определяем параметры сортировки. Порядок
        isset($_SESSION['DESC']) ? $desc = '' : $desc = 'DESC';
        isset($_SESSION['sortBy']) ? $orderBy = $_SESSION['sortBy']: $orderBy = 'id';
        //массив всех возможных значений по которым будет сортировка
        $orders=array("id", "userName", "email", "isComplete");
        $key = array_search($orderBy, $orders);
        $order = $orders[$key];
        //< определили
        $sql = "SELECT * FROM tasks ORDER BY $order $desc";
        $result = $db->query($sql);
        foreach($result as $row) {
            $tasks[] = $row;
        }        
        return $tasks;
    }

    /**
     * добавляем новую задачу в таблицу tasks в нашей бд
     * @param $userName - имя пользователя
     * @param $email - email
     * @param $task - задача
     * @param $image - ссылка на картинку
     * @return bool - если все хорошо true, иначе false
     */
    public static function addTask($userName, $email, $task, $image){
        $db = Db::getConnection();
        $sql = 'INSERT INTO tasks (userName, email, task, image) '
            . 'VALUES (:userName, :email, :task, :image)';
        $result = $db->prepare($sql);
        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':task', $task, PDO::PARAM_STR);
        $result->bindParam(':image', $image, PDO::PARAM_STR);
        if($result->execute()){
            return true;
        } else return false;
    }

    /**
     * отмечаем задачу выполненной. или наоборот снимаем выполнение
     * @return bool - если все хорошо true, иначе false
     */
    public static function markComplete($id, $complete){
        $db = Db::getConnection();
        $sql = 'UPDATE `tasks` SET `isComplete` = :complete WHERE `tasks`.`id` = :id;';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->bindParam(':complete', $complete, PDO::PARAM_STR);
        if($result->execute()){
            return true;
        } else return false;
    }

    /**
     * изменяем задачу
     * @param $id - ид задачи
     * @param $task - текст задачи
     * @return bool - если изменили true
     */    
    public static function changeTask($id, $task){
        $db = Db::getConnection();
        $sql = 'UPDATE `tasks` SET `task` = :task WHERE `tasks`.`id` = :id;';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->bindParam(':task', $task, PDO::PARAM_STR);
        if($result->execute()){
            return true;
        } else return false;
    }
}
  