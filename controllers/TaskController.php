<?php

/**
 * Контроллер для добавления задач. 
 * В нем же осуществляем проверку поступающих данных перед сохранением
 */
class TaskController
{
    public function addTask(){
        //Создаем массив, в который будем складывать ошибки
        $errors = [];
        //если есть пост запрос
        if (isset($_POST['userName'])) {
            //Проверяем имя; здесь и далее $errors - передаем ссылку на наш массив с ошибками
            // второе значение - это пременная в которую запишется значение для БД
            $this->checkUserName($errors, $userName);
            //Проверяем e-mail
            $this->checkEmail($errors, $email);
            //задачу
            $this->checkTask($errors, $task);
            //Проверяем и если все хорошо - сохраняем картинку
            $this->checkAndSaveImage($errors, $image);
            //проверям посылали мы запрос через AJAX или через HTML форму
            $isAJAX = !isset($_POST['addTask']);
            //если ошибок не было - создаем задачу
            if ($errors == false) {
                //если задача успешно добавится в БД, то получим true
                $isAddTaskSuccess = Task::addTask($userName, $email, $task, $image);
                //если через AJAX
                if ($isAJAX){
                    if($isAddTaskSuccess){
                        echo 'success';
                        return true;
                    } else exit('Ошибка');
                } else //если попали не через AJAX
                {
                    $isAddTaskSuccess ? header('Location: /'): exit('Ошибка');
                }
            } 
            //если ошибки в данных были, то они отобразятся на странице
            if ($isAJAX) {
                echo json_encode($errors);
                return true;
            } else
                require_once(ROOT . '/views/task/addTask.php');
        }
        //если мы попали сюда не пост запросом, то скорее js не работает
        //но дадим возможность создать задачу без js
        require_once(ROOT . '/views/task/addTask.php');
        return true;
    }

    public function checkComplete(){        
        if (isset($_POST['id']) and $_SESSION['user']['isAdmin']) {           
            $id = $_POST['id'];
            $complete = $_POST['complete'];            
            if(Task::checkComplete($id, $complete)) echo 'success';
            return true;
        }
        //если пост запроса не было или пользователь без админских прав
        require_once(ROOT . '/views/index.php');
        return true;
    }
    
    public function changeTask(){
        if (isset($_POST['changeTask']) and $_SESSION['user']['isAdmin']) {
            $id = $_POST['id'];
            $task = $_POST['task'];
            if(Task::changeTask($id, $task)) header('Location: /');
            return true;
        }
        //если пост запроса не было или пользователь без админских прав
        require_once(ROOT . '/views/index.php');
        return true;
    }
    
    
    
    
    
    
    
//-------------------------------------   Проверочные функции -------------------------------------------------

    /*
     * проверка имени пользователя
     * если ошибок нет, данные запишутся в $userName
     * если ошибки есть - добавятся в $errors
     */
    private function checkUserName(&$errors, &$userName){
        if (empty($_POST['userName'])) {
            $errors['userName'] = "Пожалуйста, введите ваше имя";
        } else if(strlen($_POST['userName']) < 2) {
            $errors['userName'] = "Имя должно состоять хотя бы из двух символов";
        } else if(strlen($_POST['userName']) > 31) {
            $errors['userName'] = "Имя не должно быть длинее 30 символов";
        }else if (preg_match("/[^\w\x7F-\xFF\s-]|_|\d/",$_POST['userName'])) {
            $errors['userName'] = 'только буквы русского или латинского алфавита,</br> знак "-" (дефис), пробел';
        } else $userName = strip_tags($_POST['userName']);
    }
    //проверка задачи
    private function checkTask(&$errors, &$task){
        if(!isset($_POST['task']) or strlen($_POST['task']) == ''){
            $errors['task'] = "добавьте задачу";
            return;
        }
        if(strlen($_POST['task']) > 5000) {
            $errors['task'] = "не более 5000 символов";
        }else $task = htmlspecialchars($_POST['task']);
    }
    //проверка email
    private function checkEmail(&$errors, &$email){
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Пожалуйста, введите корректный email адрес";
        }else{
            $email = $_POST['email'];
        }
    }
    /*
     * проверка и сохранение картинки.
     * ресайз если нужен
     */
    private function checkAndSaveImage(&$errors, &$image){
        if(!isset($_FILES['userImage'])){
            $errors['userImage'] = 'добавьте картинку';
            return;
        }
        if(!is_file($_FILES['userImage']['tmp_name'])){
            $errors['userImage'] = 'добавьте картинку';
            return;
        }
        // Пути загрузки файлов
        $path = '/template/users/images/';
        // Массив допустимых значений типа файла
        $types = array('image/gif', 'image/png', 'image/jpeg');
        // Максимальный размер файла
        $size = 6000000;
    // -------------------Обработка запроса---------------------------
        // Проверяем тип файла
        if (!in_array($_FILES['userImage']['type'], $types)) {
            $errors['userImage'] = 'Запрещённый тип файла. Только изображения gif, jpg, png';
            return;
        }
        $imageType = $_FILES['userImage']['type'];
        //Проверяем размер файла
        if ($_FILES['userImage']['size'] > $size){
            $errors['userImage'] = 'Слишком большой размер файла. Не более ' .round($size/1024/1024, 1) . ' MB';
            return;
        }
        if($errors == false and $_FILES['userImage']['error'] == 0){ // проверка на загрузку файла
            $fileName = $_FILES["userImage"]["name"];
            //получаем расширение файла
            $file_ext =  substr(strrchr($fileName, '.'), 1);
            //создаем уникальное имя файла. предполагаем, что загрузка файлов будет происходить не чаще раза в секунду
            $fileName = time() . "." . $file_ext;
            $target = ROOT . $path . $fileName; // путь для загрузки файла
            //если ошибок не было то пермещаем файл и сразу проверяем удачно ли
            if(move_uploaded_file($_FILES['userImage']['tmp_name'], $target)){
                $image = $path . $fileName;
                @unlink($_FILES['userImage']['tmp_name']); // удаляем временный файл
            }
            switch($imageType) {
                case "image/gif": $im = imagecreatefromgif($target); break;
                case "image/jpeg": $im = imagecreatefromjpeg($target); break;
                case "image/png": $im = imagecreatefrompng($target); break;
            }
            if(min(320/imagesx($im), 240/imagesy($im)) < 1) {
                $ration = imagesx($im)/imagesy($im);
                if($ration <= 320/240){
                    $y = 240;
                    $x = 240*$ration;
                } else {
                    $x = 320;
                    $y = 320/$ration;
                }

                $im1 = imagecreatetruecolor($x, $y); // создаем картинку
                imagecopyresampled($im1,$im,0,0,0,0,$x, $y,imagesx($im),imagesy($im));
                imagejpeg($im1, $target, 75); // переводим в jpg
                imagedestroy($im);
                imagedestroy($im1);
            }
        }else if($errors == false){
            $errors['userImage'] = 'Ошибка при загрузке файла';
        }

    }
}