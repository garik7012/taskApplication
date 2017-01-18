<?php

/**
 * 
 */
class Task
{
    /**
     * получаем список всех задач
     * @return array возвращаем в виде ассоциативного массива 
     */
    public static function getAllTasks(){
        $tasks = [];
        $db = Db::getConnection();
        $sql = "SELECT * FROM tasks";
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
}
  