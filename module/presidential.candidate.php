<?php

class presidential_candidate{

    public static function add(){

    }

    public static function update(){
        
    }

    public static function fetch($conn){

        $sql ="SELECT * FROM `tbl_presidential_candidate` ORDER BY `presidential_id` DESC LIMIT 0,3";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
        
    }

    public static function view(){
        
    }

    public static function delete(){
        
    }
}