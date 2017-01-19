<div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Изменить задачу</h4>
            </div>
            <div class="modal-body">
                <form action="/task/change" method="POST">                    
                    <div class="row">
                        <div class="col-md-12">                            
                            <div class="">
                                <textarea class="form-control" rows="4" name="task"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row"> </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <input type="hidden" name="id" value="">
                        <input id="changeTask" class="btn btn-default btn-primary" name="changeTask" type="submit" value="Сохранить"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>