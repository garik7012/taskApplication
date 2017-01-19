<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Добавить задачу</h4>
            </div>
            <div class="modal-body">
                <form id="addForm" action="/" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="file" id="userImage" multiple accept="image/*" name="userImage"/><br>
                        </div>
                        <div class="col-sm-6">
                            <i class="glyphicon glyphicon-arrow-left"></i> Выберите фото для загрузки. <p class="help-block">только JPEG, не более 5MB</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label" for="userName">Ваше имя:</label>
                            <div class="">
                                <input id="userName" class="form-control" type="text" name="userName" required/>
                            </div>
                            <label class="control-label" for="email">Ваш e-mail:</label>
                            <div class="">
                                <input id="email" class="form-control" type="text" name="email" required/>
                            </div>
                            <label for="task" class="control-label">Задача:</label>
                            <div class="">
                            <textarea id="task" class="form-control" rows="4" name="task"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button class="btn btn-default btn-primary previewTask">Предварительный просмотр</button>
                        <input class="btn btn-default btn-primary saveAndClose" name="addTask" type="submit" value="Сохранить"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
