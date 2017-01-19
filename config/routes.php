<?php

return array(

    //путь => контроллер@action
    'user/login' => 'UserController@login',
    'user/logout' => 'UserController@logout',
    'task/add' => 'TaskController@addTask',
    'task/complete' => 'TaskController@checkComplete',
    'task/change' => 'TaskController@changeTask',
    '' => 'IndexController@index',


);