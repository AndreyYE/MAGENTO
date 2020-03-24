<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 13.12.2019
 * Time: 14:13
 */

namespace app\entity;

require_once __DIR__."/Entity.php";

class User extends Entity
{
    /**
     * @return string
     * @throws \Exception
     */
    public function create()
    {
        $stmt = $this->connection->prepare("INSERT INTO users (name,password) VALUES (?,?)");

        $name = $_POST['name'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->bind_param("ss", $name, $password);

        if(!$stmt->execute()) {
            throw new \Exception($stmt->error);
        }
        $_SESSION["name"] = $name;
        $_SESSION["password"] = $password;

        return json_encode([
            'verificated_user'=>
                [
                    'email' => $name,
                    'password' => $password
                ]
             ]);

    }

    /**
     * @return bool|string
     */
    public function login()
    {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $role_id = '';
        $conn = $this->connection;
        $sql = "SELECT *
                FROM users
                WHERE name = '$name'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $checkPassword = false;
            $pass = '';
            while($row = $result->fetch_assoc()) {
                $role_id = $row['role_id'];
                if (password_verify($password, $row['password'])) {
                    $pass = $row['password'];
                    $checkPassword = true;
                }
            }
            if($checkPassword){
                $_SESSION["name"] = $name;
                $_SESSION["password"] = $pass;
                $_SESSION["role"] = $role_id;
                return json_encode([
                    'verificated_user'=>
                        [
                            'name' => $name,
                            'password' => $password
                        ]
                ]);
            }else{
                return false;
            }
        }
    }

    /**
     * Check User has role
     * @return bool|string
     */
    public function userHasRole()
    {
       if(isset($_SESSION["role"])){
           return true;
       }
       else{
           return false;
       }
    }

    public function getAllChildren()
    {
        $res = [];
        $conn = $this->connection;
        $sql = "SELECT *
                FROM users
                WHERE role_id = (SELECT id FROM roles WHERE name='Children')";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
               array_push($res, $row);
            }
            return $res;
        }
        return false;
    }

    /**
     * Check User has role
     * @param integer $role_id
     * @return bool|string
     */
    public function bindRoleToUser($role_id)
    {
        $name = $_SESSION["name"];

        $conn = $this->connection;
        $sql = "UPDATE users
                SET role_id = '$role_id'
                WHERE name = '$name'";
        if($conn->query($sql) === true)
        {
            $_SESSION["role"] = $role_id;
            return true;
        }else{
            return new \Exception('Ошибка сервера не удалось сохранить роль');
        }

    }

    /**
     * @return bool
     */
    public function is_mother()
    {
        if(isset($_SESSION['role']) and $_SESSION['role'] == 1)
        {
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return bool
     */
    public function is_father()
    {
        if(isset($_SESSION['role']) and $_SESSION['role'] == 2)
        {
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return bool
     */
    public function is_children()
    {
        if(isset($_SESSION['role']) and $_SESSION['role'] == 3)
        {
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return bool
     */
    public function permission_view()
    {
        $conn = $this->connection;
        $role_id =isset($_SESSION['role'])?$_SESSION['role']:'';
        if(!$role_id){
            return false;
        }
        $sql = "SELECT permissions.name
                FROM permissions
                INNER JOIN role_permission ON permissions.id = role_permission.permission_id
                WHERE role_permission.role_id = '$role_id'
                ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()){
                if($row['name'] == 'view'){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    public function permission_done()
    {
        $conn = $this->connection;
        $role_id =isset($_SESSION['role'])?$_SESSION['role']:'';
        if(!$role_id){
            return false;
        }
        $sql = "SELECT permissions.name
                FROM permissions
                INNER JOIN role_permission ON permissions.id = role_permission.permission_id
                WHERE role_permission.role_id = '$role_id'
                ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()){
                if($row['name'] == 'done'){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    public function permission_distribute()
    {
        $conn = $this->connection;
        $role_id =isset($_SESSION['role'])?$_SESSION['role']:'';
        if(!$role_id){
            return false;
        }
        $sql = "SELECT permissions.name
                FROM permissions
                INNER JOIN role_permission ON permissions.id = role_permission.permission_id
                WHERE role_permission.role_id = '$role_id'
                ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()){
                if($row['name'] == 'distribute'){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    public function permission_upload()
    {
        $conn = $this->connection;
        $role_id = isset($_SESSION['role'])?$_SESSION['role']:'';
        if(!$role_id){
            return false;
        }
        $sql = "SELECT permissions.name
                FROM permissions
                INNER JOIN role_permission ON permissions.id = role_permission.permission_id
                WHERE role_permission.role_id = '$role_id'
                ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()){
                if($row['name'] == 'upload'){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Get email
     * @param string $email
     */
    public function check_name_already_exists($name)
    {
        $conn = $this->connection;
        $sql = "SELECT *
                FROM users
                WHERE name = '$name'";
        $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                return true;
            }
            return false;
    }

    /**
     * @return bool|null
     */
    public function checkAuth()
    {
        $name = '';
        $password = '';
        if(isset($_SESSION['name']) and isset($_SESSION['password'])){
            $name = $_SESSION['name'];
            $password = $_SESSION['password'];
        }
        $conn = $this->connection;
        $sql = "SELECT *
                FROM users
                WHERE name = '$name'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $id = null;
            while($row = $result->fetch_assoc()) {

                if($row['password'] == $password){
                    $id = $row['id'];
                }
            }
            if($id){
                return $id;
            }else{
                return false;
            }
        }
        return false;
    }

    /**
     * redirect
     */
    public function redirect_to_login()
    {
        header("Location: ".$this->protocol_and_host."/login");
        exit();
    }
    /**
     * redirect
     */
    public function redirect_to_main()
    {
        header("Location: ".$this->protocol_and_host."/cabinet");
        exit();
    }

    /**
     * redirect
     */
    public function redirect_to_allTasks()
    {
        header("Location: ".$this->protocol_and_host."/allTasks");
        exit();
    }

}
