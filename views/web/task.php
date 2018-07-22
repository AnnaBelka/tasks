<?php

if (!empty($data['errors'])) {
    $errors = $data['errors'];
}
if (!empty($data['task'])) {
    $task = $data['task'];
}
if (!empty($data['flag_admin'])) {
    $flag_admin = $data['flag_admin'];
}

?>

<h2>Задача</h2>
<form role="form" method="post" enctype="multipart/form-data">
    <?if ($errors){?>

            <?php

            foreach ($errors as $error) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <? if ($error == 'error_email'){?>
                        Неккоректный email
                    <?}?>
                </div>
                <div class="alert alert-danger" role="alert">
                    <? if ($error == 'empty_name'){?>
                        Введите имяПользователь с таким email уже существует
                    <?}?>
                </div>
                <div class="alert alert-danger" role="alert">
                    <? if ($error == 'empty_body'){?>
                        Заполните текст задачи

                    <?}?>
                </div>
                <?
            }
            ?>

    <?}?>
    <?php
    if ($flag_admin == 1) {?>
        <div class="form-group">
            <label>Имя</label>
            <input class="form-control fn_val_name" type="text" value="<?=$task['name']?>" maxlength="255" readonly />
        </div>

        <div class="form-group">
            <label>E-mail</label>
            <input class="form-control fn_val_email" type="text" value="<?=$task['email']?>" maxlength="255" readonly />
        </div>

        <?php if ($task['image']) {?>
            <span class="border border-primary">
                <img src="/views/images/tasks/<?=$task['image']?>">
            </span>
        <?}?>

    <?} else {?>
        <div class="form-group">
            <label>Имя</label>
            <input class="form-control fn_val_name" type="text" name="name" data-format=".+" data-notice="Введите имя" value="<?=$task['name']?>" maxlength="255" />
        </div>

        <div class="form-group">
            <label>E-mail</label>
            <input class="form-control fn_val_email" type="text" name="email" data-format="email" data-notice="Введите email" value="<?=$task['email']?>" maxlength="255" />
        </div>

        <div class="form-group">
            <label for="exampleFormControlFile1">Добавить изображение</label>
            <?php if ($task['image']) {?>
                <span class="border border-primary">
                    <img src="/views/images/tasks/<?=$task['image']?>">
                </span>
            <?}?>
            <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
        </div>
<!--
        <div class="fn_dropzone dropzone<?php /*if ($task['image']) {*/?> active<?/*}*/?>">
            <a href="#" class="fn_remove_image remove_image">х</a>
            <input name="logo" value="" class="fn_dropinput dropinput fn_logo_input" type="file" />
            <?php /*if ($task['image']) {*/?>
            <input name="logo_filename" class="fn_logo_input" type="hidden" value="<?/*=$task['image']*/?>"/>
            <?/*}*/?>
            <img src="<?php /*if ($task['image']) {*/?>/views/images/tasks/<?/*=$task['image']*/?>?}?>" class="logo_image" <?php /*if (!$task['image']) {*/?>style="display: none;"<?/*}*/?>/>
        </div>-->

    <?}?>

    <div class="form-group">
        <label>Текст задачи</label>
        <textarea class="form-control" name="body" data-format=".+" data-notice="Введите текст задачи" rows="10"><?=$task['body']?></textarea>
    </div>



    <?php
    if ($_SESSION['admin']) {?>
        <div class="form-group form-check">
            <input type="checkbox" name="status" <?if ($task['status'] == 1){ ?>checked="checked"<? }?> class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Выполнена</label>
        </div>
    <?}
    ?>

    <a class="fn_task_preview btn btn-primary" href="#fn_task_preview">Предварительный просмотр</a>


    <input type="submit" name="account_user" class="btn btn-default" value="Сохранить">

</form>

<div style="display:none;">
    <table id="fn_task_preview" class="table table-hover" style="width: 500px">
        <tbody>
        <tr>
            <th scope="row">Имя</th>
            <td class="fn_name" style="width: 350px;"></td>
        </tr>
        <tr>
            <th scope="row">E-mail</th>
            <td class="fn_email" style="width: 350px;"></td>
        </tr>
        <tr>
            <th scope="row">Текст задачи</th>
            <td class="fn_body" style="width: 350px;"></td>
        </tr>
        </tbody>
    </table>
</div>