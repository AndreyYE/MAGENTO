<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title><?php echo $_SERVER['QUERY_STRING']?></title>
</head>
<body>
<?php
    $user1 = new \app\entity\User($env);
    if(($_SERVER['QUERY_STRING']=='login' || $_SERVER['QUERY_STRING']=='register') && $user1->checkAuth()){
        $user1->redirect_to_main();
    }
   elseif (!$user1->checkAuth() && ($_SERVER['QUERY_STRING']=='cabinet' || $_SERVER['QUERY_STRING']=='SelectRole' || $_SERVER['QUERY_STRING']=='allTasks' || $_SERVER['QUERY_STRING']=='myTasks' || $_SERVER['QUERY_STRING']=='createTask' || explode('&',$_SERVER['QUERY_STRING'])[0]=='addTaskToChild' || explode('&',$_SERVER['QUERY_STRING'])[0]=='doneTask' || explode('&',$_SERVER['QUERY_STRING'])[0]=='download'))
    {
        $user1->redirect_to_login();
    }
    if(count(explode('&',$_SERVER['QUERY_STRING']))<2){
        include $_SERVER['QUERY_STRING'].'.php';
    }else{
        include explode('&',$_SERVER['QUERY_STRING'])[0].'.php';
    }
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!--<script src="/app/assets/register.js"></script>-->
</body>
</html>
