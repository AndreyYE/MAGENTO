<?php
/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 13.12.2019
 * Time: 14:13
 */

namespace app\entity;

class Role extends Entity
{
    /**
     * all roles
     * @return array|bool
     */
    public function getRoles()
    {
        $conn = $this->connection;
        $res = [];
        $sql = "SELECT *
                FROM roles";
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
     * @param $role_id
     * @return array|bool
     */
    public function getRoleName($role_id)
    {
        $conn = $this->connection;
        $sql = "SELECT name
                FROM roles WHERE id = '$role_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $row = $result->fetch_assoc();
        }else{
            return false;
        }
    }

}
