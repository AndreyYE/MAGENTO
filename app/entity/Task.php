<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 13.12.2019
 * Time: 14:13
 */

namespace app\entity;

class Task extends Entity
{
    /**
     * @return array|bool
     */
    public function getAllTasks()
    {
        $conn = $this->connection;
        $res = [];
        $sql = "SELECT tasks.status, tasks.id, title, file, (SELECT name FROM users WHERE users.id = tasks.mother_id) as mother,
                (SELECT name FROM users WHERE users.id = tasks.father_id) as father,
                (SELECT name FROM users WHERE users.id = tasks.child_id) as child
                FROM tasks
                ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
           while ($row = $result->fetch_assoc())
           {
                array_push($res, $row);
           }
        }else{
            return false;
        }
        return $res;
    }

    /**
     * @return array|bool
     */
    public function getMyTasks()
    {
        $conn = $this->connection;
        $child = $_SESSION['name'];
        $res = [];
        $sql = "SELECT tasks.status, tasks.id, title, file, (SELECT name FROM users WHERE users.id = tasks.mother_id) as mother,
                (SELECT name FROM users WHERE users.id = tasks.father_id) as father,
                (SELECT name FROM users WHERE users.id = tasks.child_id) as child
                FROM tasks WHERE child_id = (SELECT id from users  WHERE name = '$child')
                ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc())
            {
                array_push($res, $row);
            }
        }else{
            return false;
        }
        return $res;
    }

    /**
     * @param $file
     * @return bool
     * @throws \Exception
     */
    public function addTask($file)
    {
        $title = $_POST['title'];
        $mother_id = (int)$_SESSION['role'];
        $stmt = $this->connection->prepare("INSERT INTO tasks (title, file, mother_id) VALUES (?,?,?)");

        $stmt->bind_param("ssd", $title, $file, $mother_id);

        if(!$stmt->execute()) {
            throw new \Exception($stmt->error);
        }

        return true;
    }

    /**
     * @return bool|\Exception
     */
    public function setChildAndFather()
    {
        $child_id = $_POST['child'];
        $father= $_SESSION['name'];
        $task_id = $_POST['task'];

        $conn = $this->connection;
        $sql = "UPDATE tasks
                SET child_id = '$child_id', father_id = (SELECT id FROM users WHERE name = '$father')
                WHERE id = '$task_id'";
        if($conn->query($sql) === true)
        {
            return true;
        }else{
            return new \Exception('Ошибка сервера не удалось сохранить роль');
        }
    }

    /**
     * @param null $task
     * @return bool
     */
    public function checkTaskBelongUser($task=null)
    {
        $task_id = $task?$task:(isset($_GET['task_id'])?$_GET['task_id']:'');
        $user= $_SESSION['name'];
        if(!$task_id){
            return false;
        }
        $conn = $this->connection;
        $sql = "SELECT *
                FROM tasks 
                WHERE id = $task_id and (father_id = (SELECT id FROM users WHERE name = '$user') 
                or mother_id = (SELECT id FROM users WHERE name = '$user')
                or child_id = (SELECT id FROM users WHERE name = '$user'))
                ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
           return true;
        }else{
            return false;
        }
    }

    /**
     * @return bool|\Exception
     */
    public function done()
    {
        $task_id = isset($_GET['task_id'])?$_GET['task_id']:'';
        if(!$task_id){
            return false;
        }else{
            $conn = $this->connection;
            $sql = "UPDATE tasks
                SET status = 'done'
                WHERE id = '$task_id'";
            if($conn->query($sql) === true)
            {
                return true;
            }else{
                return new \Exception('Не удалось изменить статус задачи');
            }
        }
    }

    /**
     * @param $task_id
     * @return bool
     */
    public function is_done($task_id)
    {
        $conn = $this->connection;
        $sql = "SELECT *
                FROM tasks
                WHERE id = '$task_id' and status = 'done'
                ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          return true;
        }else{
            return false;
        }
    }

    /**
     * @return bool|string
     */
    public function getFile()
    {
        $task_id = isset($_GET['task_id'])?$_GET['task_id']:'';
        var_dump($task_id);
        if(!$task_id){
            return false;
        }
        $conn = $this->connection;
        $file = '';
        $sql = "SELECT file
                FROM tasks
                WHERE id = '$task_id'
                ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc())
            {
                $file = $row['file'];
            }
        }else{
            return false;
        }
        return $file;
    }

}
