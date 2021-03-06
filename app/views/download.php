<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 24.03.2020
 * Time: 0:40
 */
$user =  new \app\entity\User($env);
$task = new \app\entity\Task($env);
if(!$task->checkTaskBelongUser())
{
    $user->redirect_to_allTasks();
}
$file =  $task->getFile();
if (ob_get_level()) {
    ob_end_clean();
}
// заставляем браузер показать окно сохранения файла
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . basename($file));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
// читаем файл и отправляем его пользователю
readfile($file);
$user->redirect_to_allTasks();