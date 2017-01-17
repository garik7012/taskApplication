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
                                    <a href="/task/add" class="btn btn-primary" role="button">Добавить свою</a>
                                    <a href="/user/login" class="btn btn-primary" role="button">Войти</a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
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
                                            <img class="img-thumbnail" src="<?= $task['photo']?>" width="320" height="240" alt="photo">
                                            <p><?= $task['userEmail'] ?></p>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $task['userTask']?></p>
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