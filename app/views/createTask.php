<?php
$name = '';
$password = '';
$errors = [];
$task = new app\entity\Task($env);
$user = new app\entity\User($env);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{
        if(isset($_FILES['file'])){
             $file_name = $_FILES['file']['name'];
             $new_file_name = md5($file_name);
             $file_size =$_FILES['file']['size'];
             $file_tmp =$_FILES['file']['tmp_name'];
             $file_type=$_FILES['file']['type'];
             $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));

            $extensions= array("jpeg","jpg","png","docx","txt");

            if(in_array($file_ext,$extensions)=== false){
                $errors[]="Такое расширение файла запрещено.";
            }

            if($file_size > 2097152){
                $errors[]='Размер файла слишком большой';
            }

            if(empty($errors)==true){
                $file_name_with_ext = $new_file_name.'.'.$file_ext;
                move_uploaded_file($file_tmp,"upload/".$file_name_with_ext);
                $task->addTask("upload/".$file_name_with_ext);
                $user->redirect_to_main();
            }
        }
    }
    catch (Exception $exception){
        $file = 'errors.txt';
        $current = $exception->getMessage().". File - ". __FILE__.'. Line - '.__LINE__."\r\n";
        file_put_contents($file, $current, FILE_APPEND | LOCK_EX);
    }
}
?>
<?php if($user->is_mother()):?>
<div class="alert alert-success text-center">Создать Задачу</div>
<?php if(count($errors)):?>
    <?php foreach ($errors as $val):?>
        <div class="alert alert-danger" id="register_error" style="display: <?php echo $val?'block':'nome'?>"><?php echo $val?></div>
    <?php endforeach;?>
    <?php unset($val); endif; ?>
<form class="text-center" enctype="multipart/form-data" action="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/createTask'?>" method="post">
    <div><label for="title">Название задачи</label></div>
    <div><input name="title" type="text" class="input-field <?php echo count($errors)? 'border border-danger':''?>" required></div>

    <div><label for="file">Файл</label></div>
    <div><input name="file" type="file" class="input-field <?php echo count($errors)? 'border border-danger':''?>" required></div>

    <div class="mt-3"><input type="submit" name="submit" value="Создать" class="form-submit-button"></span></div>

</form>
<?php else:; ?>
<div>Вы не можете создать задачу. Это может сделать только человек под ролью мать.</div>
<div><a class="btn btn-primary mt-3" href="<?php echo strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'].'/cabinet'?>">Кабинет</a></div>
    <?php endif; ?>