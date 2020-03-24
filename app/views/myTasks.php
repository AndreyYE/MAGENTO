<?php
$name = '';
$password = '';
$errors = [];
$task = new \app\entity\Task($env);
$user = new \app\entity\User($env);
?>
<?php if($tasks=$task->getMyTasks()):?>
    <table class="table">
    <thead>
    <tr>
        <th scope="col">Имя</th>
        <th scope="col">Создал</th>
        <th scope="col">Распределил</th>
        <th scope="col">Ребенок исполнитель</th>
        <th scope="col">Статус</th>
        <th scope="col">Скачать файл</th>
        <th scope="col">Завершить задачу</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $val):?>
        <tr>
            <td><?php echo $val['title'];?></td>
            <td><?php echo $val['mother'];?></td>
            <td><?php echo $val['father'];?></td>
            <td><?php echo $val['child'];?></td>
            <td><?php echo $val['status']?$val['status']:'пока нет';?></td>
            <td><a class="btn btn-primary mt-3" href="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/download?task_id='.$val['id']?>">Скачать</a></td>
            <?php if($task->checkTaskBelongUser($val['id']) and !$task->is_done($val['id'])):?>
                <td><a class="btn btn-primary mt-3" href="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/doneTask?task_id='.$val['id']?>">Завершить</a></td>
            <?php endif;?>
        </tr>
    <?php endforeach; unset($val);?>

<?php else: echo 'пока нет ни одной задачи'?>
    </tbody>
    </table>
<?php endif?>
<div class="text-center"><a class="btn btn-primary m-3" href="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/allTasks'?>">Все задачи</a></div>