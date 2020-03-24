<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 13.12.2019
 * Time: 11:03
 */
namespace app\entity;

abstract class Entity
{
    protected $connection;
    protected $protocol_and_host;

    public function __construct($environment)
    {
        //Подключаемся к базе данных
        $servername =$environment['DB_SERVER_NAME'] ;
        $port = $environment['DB_PORT'];
        $username = $environment['DB_USER_NAME'];
        $password = $environment['DB_PASSWORD'];
        $db_name = $environment['DB_NAME'];

        // Создаем соединение
        $conn = new \mysqli($servername, $username, $password,$db_name,$port);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $this->connection = $conn;

        //Таблица roles
        $sql = "CREATE TABLE IF NOT EXISTS roles (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(150) NOT NULL,
                UNIQUE KEY unique_name (name)
                ) ENGINE=InnoDB COLLATE=utf8_unicode_ci";
        if ($conn->query($sql) === TRUE) {

        } else {
            echo "Error creating table contacts:  " . $conn->error;
        }

        //Таблица permissions
        $sql = "CREATE TABLE IF NOT EXISTS permissions (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(150) NOT NULL,
                UNIQUE KEY unique_name (name)
                ) ENGINE=InnoDB COLLATE=utf8_unicode_ci";
        if ($conn->query($sql) === TRUE) {

        } else {
            echo "Error creating table contacts:  " . $conn->error;
        }

        //Таблица users
        $sql = "CREATE TABLE IF NOT EXISTS users (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                password VARCHAR(150) NOT NULL,
                role_id INT(6) UNSIGNED NULL,
                name VARCHAR(150) NOT NULL,
                UNIQUE KEY unique_name (name),
                CONSTRAINT `FK__role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
                ) ENGINE=InnoDB COLLATE=utf8_unicode_ci";
        if ($conn->query($sql) === TRUE) {

        } else {
            echo "Error creating table users:  " . $conn->error;
        }

        //связь многие ко многим с таблицами permissions и roles
        $sql = "CREATE TABLE IF NOT EXISTS role_permission (
                role_id INT(6) UNSIGNED,
                permission_id INT(6) UNSIGNED,
                PRIMARY KEY (role_id, permission_id),
                CONSTRAINT `FK__role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
                CONSTRAINT `FK_permission` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
                ) ENGINE=InnoDB COLLATE=utf8_unicode_ci";
        if ($conn->query($sql) === TRUE) {

        } else {
            echo "Error creating table contact_user:  " . $conn->error;
        }

        //Таблица Tasks
        $sql = "CREATE TABLE IF NOT EXISTS tasks (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                mother_id INT(6) UNSIGNED NOT NULL,
                father_id INT(6) UNSIGNED NULL,
                child_id INT(6) UNSIGNED NULL,
                title VARCHAR(150) NOT NULL,
                status VARCHAR(150) NULL,
                file CHAR(255) NOT NULL,
                CONSTRAINT `FK__mother` FOREIGN KEY (`mother_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
                CONSTRAINT `FK_father` FOREIGN KEY (`father_id`) REFERENCES `users` (`id`),
                CONSTRAINT `FK_child` FOREIGN KEY (`child_id`) REFERENCES `users` (`id`)
                ) ENGINE=InnoDB COLLATE=utf8_unicode_ci";
        if ($conn->query($sql) === TRUE) {

        } else {
            echo "Error creating table contact_user:  " . $conn->error;
        }

        $this->protocol_and_host = $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER['SERVER_NAME'];

    }
    protected function check_auth()
    {
        $authorization = getallheaders()['Authorization'];
        $time_expired='';
        $quantity='';
        $sql = "select count(*) as quantity, time_expired_token from users where token_access='$authorization'";
        $result = $this->connection->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $time_expired = $row['time_expired_token'];
                $quantity=$row['quantity'];
            }
        }
        $now = new \DateTime("NOW");
        $now->modify("-1 hour");
        $new_time =  $now->format('Y-m-d H:i:s');

        if($quantity>0 && strtotime($new_time)<strtotime($time_expired)){
            return true;
        } else {
           return false;
        }
    }
    public function __destruct()
    {
        $this->connection->close();
        // TODO: Implement __destruct() method.
    }

}