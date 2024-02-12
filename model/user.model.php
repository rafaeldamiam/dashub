<?php

Class UserModel{

    public static function takeAllUsers()
    {
        $conn = Conn::sqlite3();
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);
        $user = array();
        while($col = $result->fetchArray(SQLITE3_ASSOC)){
            $user[] = $col;
        }
        return $user;
    }

    public static function takeUserById($id){
        $conn = Conn::sqlite3();
        $sql = "SELECT * FROM user WHERE id = {$id}";
        $result = $conn->query($sql);
        while($col = $result->fetchArray(SQLITE3_ASSOC)){
            $user = $col;
        }
        return $user;
    }

    public static function addUser($name, $email, $password)
    {
        $conn = Conn::sqlite3();
        $sql = "INSERT INTO user(name, email, password, profile_img, role) VALUES ('{$name}', '{$email}', '{$password}', ' ', 'user')";
        $result = $conn->query($sql);
        if(!$result) { die('Error while INSERT user'); }
        return "User Successfuly INSERTED!";
    }

    public static function editUser($id, $name, $email, $password, $profile_img)
    {
        $conn = Conn::sqlite3();
        $sql = "UPDATE user SET name = '{$name}', email = '{$email}', password = '{$password}', profile_img = '{$profile_img}' WHERE id = {$id}";
        $result = $conn->query($sql);
        if(!$result){
            die("Error while UPDATE user");
        }
        return "User Successfuly UPDATED!";
    }

    public static function deleteUser($id)
    {
        $conn = Conn::sqlite3();
        $sql = "DELETE FROM user WHERE id = {$id}";
        $result = $conn->query($sql);
        if(!$result)
        {
            die("Erro while DELETE user");
        }
        if($_SESSION["access"]["id"] == $id)
        {
            redirectView("login/logout");
        }
        
        return "User Successfuly DELETED!";
    }

    public static function takeUserByEmailPassword($email, $password)
    {
        $conn = Conn::sqlite3();
        $sql = "SELECT * FROM user WHERE email = '{$email}' AND password = '{$password}'";
        $result = $conn->query($sql);
        while ($col = $result->fetchArray(SQLITE3_ASSOC))
        {
            $user = $col;
        }
        return $user;
    }

    public static function editUserProfileImage($id, $profile_img)
    {
        $conn = Conn::sqlite3();
        $sql = "UPDATE user SET profile_img = '{$profile_img}' WHERE id = {$id}";
        $result = $conn->query($sql);
        if(!$result){
            die("Error while UPDATE user profile");
        }
        return "User Successfuly UPDATED!";
    }
}