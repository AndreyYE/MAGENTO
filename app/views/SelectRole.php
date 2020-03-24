<?php
$name = '';
$password = '';
$errors = [];
$user = new \app\entity\User($env);
$role = new \app\entity\Role($env);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{
        $user->bindRoleToUser($_POST['role']);
        $user->redirect_to_main();
    }catch (Exception $exception){
        $file = 'errors.txt';
        $current = $exception->getMessage().". File - ". __FILE__.'. Line - '.__LINE__."\r\n";
        file_put_contents($file, $current, FILE_APPEND | LOCK_EX);
        array_push($errors, $exception->getMessage());
    }
}
 ?>
<?php if($role->hasRoles()):?>
<div class="alert alert-success text-center">Выберите роль</div>
    <?php if(count($errors)):?>
        <?php foreach ($errors as $val):?>
            <div class="alert alert-danger" id="register_error" style="display: <?php echo $val?'block':'nome'?>"><?php echo $val?></div>
        <?php endforeach;?>
        <?php unset($val); endif; ?>
<form class="text-center" method="post" action="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/SelectRole'?>">
    <select name="role" id="role">
        <?php if($roles = $role->getRoles()):?>
        <?php foreach ($roles as $val):?>
                <option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
        <?php endforeach; unset($val);?>
        <?php else:?>
            <option value="">Нет ни одной роли</option>
        <?php endif;?>
    </select>
    <div class="mt-3"><input type="submit" name="submit" value="Выбрать роль" class="form-submit-button"></span></div>
</form>
<?php else: echo 'Нет ни одной роли'?>
<?php endif;?>
<div class="text-center"><a class="btn btn-primary m-3" href="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/cabinet'?>">Кабинет</a></div>