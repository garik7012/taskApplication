<?php include ROOT . '/views/layouts/header.php'; ?>
<?php
/**
 * функция отмечает по какому полю у нас сортировка
 * @param $field - кнопка с полем
 * @return bool|string
 */
function checkActive($field)
{
    if (isset($_SESSION['sortBy']) and ($_SESSION['sortBy'] == $field)) return 'checked';
    return false;
}

/**
 * функция определяем порядок сортировки
 * @param $field - кнопка с полем
 * @return bool|string
 */
function checkDesc($field)
{
    if (checkActive($field) and isset($_SESSION['DESC'])) return 'glyphicon-arrow-up';
    return 'glyphicon-arrow-down';
}

?>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="panel-title form-title hidden-xs col-sm-4">
                                <span>Список задач </span>
                            </div>
                            <div class="col-xs-6 col-sm-4 text-center">
                                <button class="sort <?= checkActive('userName'); ?>" data-sort="userName"
                                        title="Сортировать по имени">
                                    <span class="glyphicon glyphicon-user"></span>
                                    <span class="glyphicon <?= checkDesc('userName') ?>"></span>
                                </button>
                                <button class="sort <?= checkActive('email'); ?>" data-sort="email"
                                        title="Сортировать по email">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                    <span class="glyphicon <?= checkDesc('email') ?>"></span>
                                </button>
                                <button class="sort <?= checkActive('isComplete'); ?>" data-sort="isComplete"
                                        title="Сортировать по выполнению">
                                    <span class="glyphicon glyphicon-ok"> </span>
                                    <span class="glyphicon <?= checkDesc('isComplete') ?>"></span>
                                </button>
                            </div>
                            <div class="col-xs-6 col-sm-4">
                                <a href="/task/add" class="btn btn-primary addTask" role="button">Добавить свою</a>
                                <?php if (isset($_SESSION['user'])): ?>
                                    <a href="/user/logout" class="btn btn-primary logout" role="button">Выйти</a>
                                <?php else: ?>
                                    <a href="/user/login" class="btn btn-primary login" role="button">Войти</a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <section class="previewField">
                            <div class="col-sm-12">
                                <h3 class="userName"></h3>
                            </div>
                            <div class="col-sm-4">
                                <img id="img-preview" class="img-thumbnail img" src="/template/users/images/default.png"
                                     alt="photo">
                                <p class="email"></p>
                            </div>
                            <div class="col-sm-8">
                                <pre class="task"></pre>
                                <p>
                                    <a href="#" class="btn btn-primary editPreview" role="button">Продолжить</a>
                                    <a href="#" class="btn btn-primary savePreview" role="button">Сохранить</a>
                                </p>
                                <p><a href="#" class="btn btn-danger deletePreview" role="button">Удалить</a></p>
                            </div>
                        </section>
                        <?php if (empty($tasks)) {
                            echo '<section>
                                        <h2>Eще нет задач</h2>
                                      </section>';
                        } else foreach ($tasks as $task): ?>
                            <section id="task_<?= $task['id'] ?>">
                                <div class="col-sm-12">
                                    <h3><?= $task['userName'] ?></h3>
                                </div>
                                <div class="col-sm-4">
                                    <img class="img-thumbnail img" src="<?= $task['image'] ?>" alt="photo">
                                    <p><?= $task['email'] ?></p>
                                </div>
                                <div class="col-sm-8">
                                    <pre class="showTask task"><?= $task['task'] ?></pre>
                                    <?php if ($task['isComplete']): ?>
                                        <span class="glyphicon glyphicon-ok text-success"> </span>
                                        <span> Выполнена!</span>
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['user']) and $_SESSION['user']['isAdmin']): ?>
                                        <p><a href="#" class="btn btn-primary editTask" role="button"
                                              data-id="<?= $task['id'] ?>">Редактировать</a></p>
                                        <p><label>
                                                <input type="checkbox" class="checkComplete"
                                                       data-id="<?= $task['id'] ?>"
                                                    <?php if ($task['isComplete']) echo 'checked' ?>> Отметить как
                                                выполненую
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

    <!-- Modals -->
<?php include ROOT . '/views/layouts/modalAdd.php'; ?>
<?php include ROOT . '/views/layouts/modalLogin.php'; ?>
<?php include ROOT . '/views/layouts/modalChangeTask.php'; ?>

<?php include ROOT . '/views/layouts/footer.php'; ?>