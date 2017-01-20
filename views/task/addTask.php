<?php
/**
 * на эту страницу мы попадаем по адресу /task/add
 * или если у пользователя не работает JS
 * дает возможность создать задачу без использования скриптов 
 */
?>
<?php include ROOT . '/views/layouts/header.php'; ?>
<?php
if(!isset($errors)) $errors = false;
/**
 * функция обработки и вывода ошибок 
 * @param $field - поле, которое мы проверяем на наличие ошибок
 * @param $errors - массив с ошибками
 */
function checkError($field, $errors){
    if(isset($errors[$field])){
        echo '<span class="errorSpan help-block"><strong>'. $errors[$field] .'</strong></span>';
    }
}?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="panel-title form-title col-sm-12 text-center">Добавить задачу</div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="modal-body">
                                        <form action="/task/add" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6 <?php if(isset($errors['userImage'])) echo 'has-error';?>">
                                                    <input type="file" id="userImage" multiple accept="image/*" name="userImage"/><br>
                                                    <?php checkError('userImage', $errors) ?>
                                                </div>
                                                <div class="col-sm-6 <?php if(isset($errors['userImage'])) echo 'has-error';?>">
                                                    <i class="glyphicon glyphicon-arrow-left"></i> Выберите фото для загрузки. <p class="help-block">только JPEG, не более 5MB</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="control-label" for="userName">Ваше имя:</label>
                                                    <div class="<?php if(isset($errors['userName'])) echo 'has-error';?>">
                                                        <input id="userName" class="form-control" type="text" name="userName"
                                                               value="<?php if(isset($userName)) echo $userName?>" required/>
                                                        <?php checkError('userName', $errors) ?>
                                                    </div>
                                                    <label class="control-label" for="email">Ваш e-mail:</label>
                                                    <div class="<?php if(isset($errors['email'])) echo 'has-error';?>">
                                                        <input id="email" class="form-control" type="text" name="email"
                                                               value="<?php if(isset($email)) echo $email?>" required/>
                                                        <?php checkError('email', $errors) ?>
                                                    </div>
                                                    <label for="task" class="control-label">Задача:</label>
                                                    <div class="<?php if(isset($errors['task'])) echo 'has-error';?>">
                                                        <textarea id="task" class="form-control" rows="4" name="task"><?php if(isset($task)) echo $task?></textarea>
                                                        <?php checkError('task', $errors) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row"> </div>
                                            <div class="modal-footer">
                                                <a role="button" class="btn btn-default " href="/">Назад, на главную</a>
                                                <input class="btn btn-default btn-primary" name="addTask" type="submit" value="Сохранить"/>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include ROOT . '/views/layouts/footer.php'; ?>
