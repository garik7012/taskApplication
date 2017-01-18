$(document).ready(function() {
    //показываем модальное окно при нажитии кнопки Добавить свою
    $('.addTask').click(function(){
        $('#addModal').modal();
        return false;
    });
    //вновь показываем модальное окно после предпросмотра. при нажатии кнопки продолжить
    $('.editPreview').click(function () {
        $('#addModal').modal();
        return false;
    });
    //скрывам предпросмотр при нажатии кнопки удалить
    $('.deletePreview').click(function () {
       $('.previewField').hide();
        return false;
    });
    
    //создаем пременную для хранения ошибок при загрузке изображения.
    // заначение false - можно делать предпросмотр без загрузки картинки
    var imgError = false;
    /*следим за добавлением изображения
     если файл был выбран, проверяем его на то, чтоб он был изображением
     если да, то добавляем его в наше поле предпросмотра
     без отправки на сервер
     */
    $('#img').change(function () {
        var input = $(this)[0];
        if (input.files && input.files[0]) {
            if (input.files[0].type.match('image.*')) {
                image = new FileReader();
                image.onload = function (e) {
                    $('#img-preview').attr('src', e.target.result);
                }
                image.readAsDataURL(input.files[0]);
            } else {
                imgError = 'ошибка, не изображение';
                return;
            }
        } else {
            imgError = 'ошибка, возможно файл не выбран';
            return;
        }
        imgError = false;
    });
    //   -----------действия при нажитии предпросмотра-------------
    $('.previewTask').click(function(){
        var errors = false;
        //при повторной отправке удаляем все ошибки
        $('.errorSpan').remove();
        $('.has-error').removeClass('has-error');        

        //проверка введенного имени
        var userName = $('#userName').val();
        var reg = /^[а-яА-ЯёЁa-zA-Z -]+$/;
        var err = '';
        if(userName.length < 2 )  err = "Не менее 2-х символов";
        if(userName.length > 31) err = "Не более 30 символов";
        if(!reg.test(userName)) err = 'Только буквы русского и латинского алфавита, знак "-" (дефис), пробел';
        if(err) showError('userName', err);

        //проверка email
        var email = $('#email').val();
        emailReg = /^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i;
        if(!emailReg.test(email) || email == '')
        {
            showError('email', "Пожалуйста, введите ваш e-mail");
        }
        //проверяем, добавлена ли задача. если добавлена, то не более 5000 символов
        var task = $('#task').val();
        if(task == '') showError('task', 'Пожалуйста, добавьте задачу');
        if(task.length > 5000) showError('task', 'Не более 5000 символов');
        
        //проверяем были ли ошибки при добавлении файла. если были - показываем
        if(imgError) showError('img', imgError);
        
        //если были ошибки при заполнении полей, то выходим
        if(errors) return false;

        //если ошибок не было, убираем модаль, заполняем поля предпросмотра и показываем его
        $('#addModal').modal('hide');
        pF = $('.previewField');
        pF.find(".userName").text(userName);
        pF.find('.email').text(email);
        pF.find('.task').text(task);
        pF.show();
        return false;

        /**
         * функция выводит ошибки при заполнении полей. Помечает errors = true;
         * @param fieldName - поле в котором у нас ошибка 
         * @param err - текст ошибки
         */
        function showError(fieldName, err) {
            //создаем поле для вывода ошибок. его будем клонировать
            errorField = $('<span class="errorSpan help-block"><strong></strong></span>');
            //отмечаем, что ошибки есть
            errors = true;
            //выводим ошибку
            eF = errorField.clone();
            eF.children().text(err);
            $('#' + fieldName).after(eF);
            $('#' + fieldName).parent().addClass('has-error');
        }
    });
});
