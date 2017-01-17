<?php

/**
 * 
 */
class Task
{
    public static function getAllTasks(){
        $tasks = [];
        //получаем список задач пользователей
        
        //допустим получили
        $tasks[] = ['userName' => 'Name Lastov',
                    'userEmail' => 'email@gmail.com',
                    'photo' => '/template/users/images/test.jpg',
                    'userTask' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis, sunt!'];
        return $tasks;
    }
}
  