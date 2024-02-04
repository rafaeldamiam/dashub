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

    public static function showSiteById($id){
        $conn = Conn::sqlite3();
        $sql = "SELECT s.title AS sitetitle, s.logo AS sitelogo, s.url AS siteurl, s.description AS sitedescription, s.dt_insert, u.name AS username, t.nickname AS tagnickname, t.name AS tagname FROM site s, user u, tag t WHERE s.id_owner = u.id AND s.id_tag = t.id AND s.id = {$id}";
        $result = $conn->query($sql);
        while($col = $result->fetchArray(SQLITE3_ASSOC)){
            $site = $col;
        }
        return $site;
    }

    public static function takeSiteById($id){
        $conn = Conn::sqlite3();
        $sql = "SELECT s.title AS sitetitle, s.logo AS sitelogo, s.url AS siteurl, s.description AS sitedescription, t.nickname AS tagnickname, t.name AS tagname FROM site s, tag t WHERE s.id_tag = t.id AND s.id = {$id}";
        $result = $conn->query($sql);
        while($col = $result->fetchArray(SQLITE3_ASSOC)){
            $site = $col;
        }
        return $site;
    }

    public static function addSite($name, $email, $password)
    {
        $conn = Conn::sqlite3();
        $sql = "INSERT INTO site(name, email, password, role)VALUES ('{$name}', '{$email}', '{$password}',  'site')";
        $result = $conn->query($sql);
        if(!$result) { die('Error while INSERT site'); }
        return "site Successfuly INSERTED!";
    }

    public static function editSite($id, $name, $email)
    {
        $conn = Conn::sqlite3();
        $sql = "UPDATE site SET name = '{$name}', email = '{$email}' WHERE id = {$id}";
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
        if(!$result){die("Erro while DELETE site");}
        
        return "site Successfuly DELETED!";
    }

}