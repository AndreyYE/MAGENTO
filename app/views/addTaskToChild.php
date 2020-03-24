<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 23.03.2020
 * Time: 22:11
 */
$errors = [];
$task_id = isset($_GET['task_id'])?$_GET['task_id']:'';
$user = new \app\entity\User($env);
$task = new \app\entity\Task($env);
if(!$user->permission_distribute())
{
    $user->redirect_to_main();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{
        $task->setChildAndFather();
        $user->redirect_to_allTasks();
    }catch (Exception $exception)
    {
        $file = 'errors.txt';
        $current = $exception->getMessage().". File - ". __FILE__.'. Line - '.__LINE__."\r\n";
        file_put_contents($file, $current, FILE_APPEND | LOCK_EX);
        $user->redirect_to_allTasks();
    }
}

?>
<form class="text-center" action="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/addTaskToChild'?>" method="post" id="frmLogin1">
    <div><label for="child">Список детей для поручения задания</label></div>
    <?php if(count($errors)):?>
        <?php foreach ($errors as $val):?>
            <div class="alert alert-danger" id="register_error" style="display: <?php echo $val?'block':'nome'?>"><?php echo $val?></div>
        <?php endforeach;?>
        <?php unset($val); endif; ?>
    <?php if($children = $user->getAllChildren()):?>
    <select name="child">
        <?php foreach ($children as $child):?>
        <option value="<?php echo $child['id']?>"><?php echo $child['name']?></option>
        <?php endforeach;?>
    </select>
    <?php else:?>
    <div>Нет ни одного ребенка</div>
    <?php endif;?>

   <input name="task" type="hidden" value="<?php echo $task_id?>" class="input-field">
    <div><input type="submit" name="submit" value="Добавить" class="form-submit-button"></span></div>
    <div><a class="btn btn-primary mt-3" href="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/cabinet'?>">Кабинет</a></div>

</form>
