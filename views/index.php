<?php include ROOT . '/views/layouts/header.php'; ?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="panel-title form-title col-sm-7 col-sm-offset-1">Список задач</div>
                                <div class=" col-sm-4">
                                    <a href="/task/add" class="btn btn-primary addTask" role="button">Добавить свою</a>
                                    <?php if(isset($_SESSION['user'])): ?>
                                    <a href="/user/logout" class="btn btn-primary logout" role="button">Выйти</a>
                                    <?php else: ?>
                                    <a href="/user/login" class="btn btn-primary login" role="button">Войти</a>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <section class="previewField">
                                <div class="col-md-12">
                                    <h3 class="userName"></h3>
                                </div>
                                <div class="col-md-4">
                                    <img id="img-preview" class="img-thumbnail" src="/template/users/images/default.png" width="320" height="240" alt="photo">
                                    <p class="email"></p>
                                </div>
                                <div class="col-md-8">
                                    <p class="task"></p>
                                    <p><a href="#" class="btn btn-primary editPreview" role="button">Продолжить</a></p>
                                    <p><a href="#" class="btn btn-danger deletePreview" role="button">Удалить</a></p>
                                </div>
                            </section>
                            <?php if(empty($tasks)){
                                echo '<section>
                                        <h2>Eще нет задач</h2>
                                      </section>';
                            }else foreach($tasks as $task): ?>
                                    <section id="task_<?=$task['id']?>">
                                        <div class="col-md-12">
                                            <h3><?= $task['userName']?></h3>
                                        </div>
                                        <div class="col-md-4">
                                            <img class="img-thumbnail" src="<?= $task['image']?>" width="320" height="240" alt="photo">
                                            <p><?= $task['email'] ?></p>
                                        </div>
                                        <div class="col-md-8">
                                                <p class="showTask"><?= $task['task']?></p>
                                            <?php if($task['isComplete']): ?>
                                                <span class="glyphicon glyphicon-ok text-success"> </span><span> Выполнена!</span>
                                            <?php endif; ?>
                                            <?php if(isset($_SESSION['user']) and $_SESSION['user']['isAdmin']): ?>
                                                <p><a href="#" class="btn btn-primary editTask" role="button" data-id="<?=$task['id']?>">Редактировать</a></p>
                                                <p><label>
                                                        <input type="checkbox" class="checkComplete" data-id="<?= $task['id']?>"
                                                                <?php if($task['isComplete']) echo 'checked' ?>> Отметить как выполненую
                                                   </label>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </section>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php include ROOT . '/views/layouts/footer.php'; ?>