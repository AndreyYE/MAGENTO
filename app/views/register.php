<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 18.03.2020
 * Time: 17:20
 */

$name = '';
$password = '';
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{
        $user = new \app\entity\User($env);
        // Validation
        if( $user->check_name_already_exists($_POST['name'])){
            array_push($errors, 'Такое имя уже существует напишите другое.');
            $name = $_POST['name'];
            $password = $_POST['password'];
        }
        // if validation is ok then we create new user
        if(isset($_POST['name']) and $_POST['password']){
            $user->create();
            $user->redirect_to_main();
        }
    }catch (Exception $exception){
        $file = 'errors.txt';
        $current = $exception->getMessage().". File - ". __FILE__.'. Line - '.__LINE__."\r\n";
        file_put_contents($file, $current, FILE_APPEND | LOCK_EX);
    }
}
?>
<div class="alert alert-success text-center">Регистрация</div>
<?php if(count($errors)):?>
    <?php foreach ($errors as $val):?>
    <div class="alert alert-danger" id="register_error" style="display: <?php echo $val?'block':'nome'?>"><?php echo $val?></div>
    <?php endforeach;?>
<?php unset($val); endif; ?>
<form class="text-center"action="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/register'?>" method="post" id="frmLogin">
        <div><label for="name">Имя</label></div>
        <div><input name="name" type="text" value="<?php echo $name?$name:''?>" class="input-field <?php echo count($errors)? 'border border-danger':''?>" required  minlength="3"></div>

        <div><label for="password">Пароль</label></div>
        <div><input name="password" type="password" value="<?php echo $password?$password:''?>" class="input-field" required minlength="8"></div>

        <div><input type="submit" name="submit" value="Регистрация" class="form-submit-button"></span></div>
    <div><a class="btn btn-primary mt-3" href="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/login'?>">Логин</a></div>

</form>
