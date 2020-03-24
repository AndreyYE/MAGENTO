<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/app/entity/User.php");
include($_SERVER['DOCUMENT_ROOT'] . "/app/entity/Role.php");
include($_SERVER['DOCUMENT_ROOT'] . "/app/entity/Task.php");
include($_SERVER['DOCUMENT_ROOT'] . "/environment.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'app/views/app.php';
}elseif ($_SERVER["REQUEST_METHOD"]=="GET"){
    if($_SERVER['QUERY_STRING']=="login"
        || $_SERVER['QUERY_STRING']=="register"
        || $_SERVER['QUERY_STRING']=="cabinet"
        || $_SERVER['QUERY_STRING']=="SelectRole"
        || $_SERVER['QUERY_STRING']=='allTasks'
        || $_SERVER['QUERY_STRING']=='myTasks'
        || $_SERVER['QUERY_STRING']=='createTask'
        || explode('&',$_SERVER['QUERY_STRING'])[0]=='addTaskToChild'
        || explode('&',$_SERVER['QUERY_STRING'])[0]=='doneTask'
        || explode('&',$_SERVER['QUERY_STRING'])[0]=='download'){
        include 'app/views/app.php';
    }
else{
    header("Location: ".strtolower(explode('/',$_SERVER['SERVER_PROTOCOL'])[0])."://".$_SERVER['HTTP_HOST']."/cabinet");
    exit();
}
}

