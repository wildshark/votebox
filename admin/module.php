<?php

switch($_REQUEST['submit']){

    case"login";
        
        if(($_REQUEST['email'] !== "a@a.com" )|| ($_REQUEST['password'] !== "pass")){
            require('admin/template/login.php');
        }else{
            $_SESSION['token'] = uniqid(); 
            $url['_route'] ="dashboard";
        }

    break;

    case"add-voter";
        
        $date = date('Y-m-d H:i:s');
        $name = ucwords($_REQUEST['student-name']);
        $index = strtoupper($_REQUEST['student-index']);
        $pin = $_REQUEST['student-pin'];
        $status = 1;

        $sql = 'INSERT INTO "main"."tbl_candidate"("created_date", "fname", "index_num", "candidate_code", "status_id") VALUES (:date,:name,:stindex,:pinnum,:status)';
        $stmt = $db->prepare($sql);
 
		$stmt->bindParam(':date', $date);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':stindex', $index);
        $stmt->bindParam(':pinnum', $pin);
        $stmt->bindParam(':status', $status);
 
		if(false == $stmt->execute()){
            $url['_route'] ="voter";
            $url['status'] ="fail";
        }else{
            $url['_route'] ="voter";
            $url['status'] ="sucessful";
        }

    break;

    case"add-candidate";    
            
        $name = $_REQUEST['candidate'];
        $pic = $_REQUEST["picture"];
        $election_id = $_SESSION['election_id'];
        $sql = 'INSERT INTO "main"."tbl_presidential_candidate"("election_id", "presidential_name", "photo") VALUES (:election,:name,:pic)';
        $stmt = $db->prepare($sql);
     
        $stmt->bindParam(':election', $election_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':pic', $pic);
            
        if(false == $stmt->execute()){
            $url['_route'] ="candidate";
            $url['status'] ="fail";
            $url['election'] = $election_id;
        }else{
            $url['_route'] ="candidate";
            $url['status'] ="sucessful";
            $url['election'] = $election_id;
        }

    break;

    case"add-election";
        
        $year = $_REQUEST['election-year'];
        $election = $_REQUEST['election-name'];

        $sql = 'INSERT INTO "main"."tbl_election"("election_name", "election_year") VALUES (:election,:election_year)';
        $stmt = $db->prepare($sql);
    
        $stmt->bindParam(':election_year', $year);
        $stmt->bindParam(':election', $election);
                    
        if(false == $stmt->execute()){
            $url['_route'] ="election";
            $url['status'] ="fail";
        }else{
            $url['_route'] ="election";
            $url['status'] ="sucessful";
        }

    break;
}

$url['token'] = $_SESSION['token'];
header("location: ?".http_build_query($url));
?>