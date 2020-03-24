<?php
$name = '';
$password = '';
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{
        $user = new \app\entity\User($env);
        if( !$user->login()){
            array_push($errors, 'Вы неверно указали имя или пароль.');
            $name = $_POST['name'];
            $password = $_POST['password'];
        }else{
            $user->redirect_to_main();
        }
    }
    catch (Exception $exception){
        $file = 'errors.txt';
        $current = $exception->getMessage().". File - ". __FILE__.'. Line - '.__LINE__."\r\n";
        file_put_contents($file, $current, FILE_APPEND | LOCK_EX);
    }
}
?>
<div class="alert alert-success text-center">Логин</div>
<?php if(count($errors)):?>
    <?php foreach ($errors as $val):?>
        <div class="alert alert-danger" id="register_error" style="display: <?php echo $val?'block':'nome'?>"><?php echo $val?></div>
    <?php endforeach;?>

    <?php unset($val); endif; ?>
<form class="text-center"action="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/login'?>" method="post" id="frmLogin1">
    <div><label for="name">Имя</label></div>
    <div><input name="name" type="text" value="<?php echo $name?$name:''?>" class="input-field <?php echo count($errors)? 'border border-danger':''?>" required></div>

    <div><label for="password">Пароль</label></div>
    <div><input name="password" type="password" value="<?php echo $password?$password:''?>" class="input-field <?php echo count($errors)? 'border border-danger':''?>" required minlength="8"></div>

    <div class="mt-3"><input type="submit" name="submit" value="Логин" class="form-submit-button"></span></div>
    <div><a class="btn btn-primary mt-3" href="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/register'?>">Регистрация</a></div>

</form>
