<?php

class candidate{

    public static function search($conn,$q){

        $sql = "SELECT * FROM `tbl_candidate` WHERE `candidate_code`=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$q]);
        return $stmt->fetch();
    }

    public static function add(){




        $statement = $sqlite->prepare('SELECT * from  foo');
        try
            {
                $statement->execute();
            }
            catch(PDOException $e)
            {
                echo "Statement failed: " . $e->getMessage();
                return false;
            }

        $result = $statement->fetchAll();
        var_dump($result);
    }

    public static function update(){
        
    }

    public static function fetch(){
        
    }

    public static function view(){
        
    }

    public static function delete(){
        
    }
}