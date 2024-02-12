<?php

Class SiteModel{

    public static function takeAllSites()
    {
        $conn = Conn::sqlite3();
        $sql = "SELECT * FROM site";
        $result = $conn->query($sql);
        $site = array();
        while($col = $result->fetchArray(SQLITE3_ASSOC)){
            $site[] = $col;
        }
        return $site;
    }

    public static function takeSiteById($id){
        $conn = Conn::sqlite3();
        $sql = "SELECT * FROM site WHERE id = {$id}";
        $result = $conn->query($sql);
        while($col = $result->fetchArray(SQLITE3_ASSOC)){
            $site = $col;
        }
        return $site;
    }

    public static function takeSiteLogoById($id){
        $conn = Conn::sqlite3();
        $sql = "SELECT logo FROM site WHERE id = {$id}";
        $result = $conn->query($sql);
        while($col = $result->fetchArray(SQLITE3_ASSOC)){
            $site = $col;
        }
        return $site;
    }

    public static function addSite($title, $url, $description)
    {
        $dt_now = date('Y-m-d');
        $conn = Conn::sqlite3();
        $sql = "INSERT INTO site(title, url, description, logo, id_tag, dt_insert, id_owner) VALUES ('{$title}', '{$url}', '{$description}', ' ', '1', '{$dt_now}' , '{$_SESSION['access']['id']}')";
        $result = $conn->query($sql);
        if(!$result) { die('Error while INSERT site'); }
        return "site Successfuly INSERTED!";
    }

    public static function editSite($id, $title, $url, $description, $logo)
    {
        $conn = Conn::sqlite3();
        $sql = "UPDATE site SET title = '{$title}', url = '{$url}', description = '{$description}', logo = '{$logo}' WHERE id = {$id}";
        $result = $conn->query($sql);
        if(!$result){
            die("Error while UPDATE site");
        }
        return "site Successfuly UPDATED!";
    }

    public static function deleteSite($id)
    {
        $conn = Conn::sqlite3();
        $sql = "DELETE FROM site WHERE id = {$id}";
        $result = $conn->query($sql);
        if(!$result)
        {
            die("Erro while DELETE site");
        }
        if($_SESSION["access"]["id"] == $id)
        {
            redirectView("login/logout");
        }
        
        return "site Successfuly DELETED!";
    }

    public static function takesiteByUrlDescription($url, $description)
    {
        $conn = Conn::sqlite3();
        $sql = "SELECT * FROM site WHERE url = '{$url}' AND description = '{$description}'";
        $result = $conn->query($sql);
        while ($col = $result->fetchArray(SQLITE3_ASSOC))
        {
            $site = $col;
        }
        return $site;
    }

    public static function editSiteLogo($id, $profile_img)
    {
        $conn = Conn::sqlite3();
        $sql = "UPDATE site SET logo = '{$profile_img}' WHERE id = {$id}";
        $result = $conn->query($sql);
        if(!$result){
            die("Error while UPDATE site profile");
        }
        return "site Successfuly UPDATED!";
    }
}