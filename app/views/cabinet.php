<?php
$name = '';
$password = '';
$errors = [];
$user = new \app\entity\User($env);
$role = new \app\entity\Role($env);
?>
<?php if(!$user1->userHasRole()):?>
<div class="text-center"><a class="btn btn-primary mt-3" href="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/SelectRole'?>">Выберите Роль</a></div>
<?php endif;?>
<div class="alert alert-success text-center mt-3">Информация о пользователе</div>
<table class="table text-center">
    <thead>
    <tr>
        <th scope="col">Имя</th>
        <th scope="col">Роль</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo $_SESSION['name'];?></td>
        <td><?php echo $role->getRoleName(isset($_SESSION['role'])?$_SESSION['role']:'')['name'];?></td>
    </tr>
    </tbody>
</table>
<?php if($user1->permission_view()):?>
    <div class="text-center"><a class="btn btn-primary mt-3" href="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/allTasks'?>">Все задачи</a></div>
<?php endif;?>
<?php if($user1->is_children()):?>
    <div class="text-center"><a class="btn btn-primary mt-3" href="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/myTasks'?>">Мои задачи</a></div>
<?php endif;?>

<?php if($user1->permission_upload()):?>
    <div class="text-center"><a class="btn btn-primary mt-3" href="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/createTask'?>">Создать Задачу</a></div>
<?php endif;?>