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
                                    <a href="/user/login" class="btn btn-primary" role="button">Войти</a>
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
                                echo '<article>
                                        <h2>Eще нет задач</h2>
                                      </article>';
                            }else foreach($tasks as $task): ?>
                                    <section>
                                        <div class="col-md-12">
                                            <h3><?= $task['userName']?></h3>
                                        </div>
                                        <div class="col-md-4">
                                            <img class="img-thumbnail" src="<?= $task['image']?>" width="320" height="240" alt="photo">
                                            <p><?= $task['email'] ?></p>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $task['task']?></p>
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