<?php

if (!empty($data['errors'])) {
    $errors = $data['errors'];
}
if (!empty($data['login'])) {
    $login = $data['login'];
}

?>
<h2>Войти</h2>
<form method="post">
    <?if ($errors){?>
        <div class="bg-danger">
            <?php

            foreach ($errors as $error) {
                ?>
                <div class="text-danger">
                    <? if ($error == 'error_login'){?>
                        Неккоректный логин или пароль
                    <?}?>
                </div>
                <?
            }
            ?>
        </div>
    <?}?>
    <div class="form-group">
        <label for="exampleInputEmail1">Login</label>
        <input type="text" data-format=".+" data-notice="Введите логин" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter login" name="login" value="<?=$login?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" data-format=".+" data-notice="Введите пароль" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>

    <button type="submit" class="btn btn-primary">Войти</button>
</form>