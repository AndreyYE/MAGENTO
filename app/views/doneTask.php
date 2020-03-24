<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 23.03.2020
 * Time: 23:26
 */
$task =  new \app\entity\Task($env);
$user =  new \app\entity\User($env);
if(!$user->permission_done()){
    $user->redirect_to_main();
}
if($task->checkTaskBelongUser())
{
    try {
        $task->done();
        $user->redirect_to_allTasks();
    }catch (Exception $exception){
        $file = 'errors.txt';
        $current = $exception->getMessage().". File - ". __FILE__.'. Line - '.__LINE__."\r\n";
        file_put_contents($file, $current, FILE_APPEND | LOCK_EX);
        $user->redirect_to_allTasks();
    }
}