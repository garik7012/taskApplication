<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="text-center">Войти</h3>
            </div>
            <div class="modal-body">
                <form class="form center-block" action="/user/login" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="логин" name="login">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="пароль" name="password">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Вход</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Отмена</button>
            </div>
        </div>
    </div>
</div>