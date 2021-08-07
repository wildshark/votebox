<?php

include("admin/control/global.php");

$label =$admin_lang['login_page'];

if(!isset($_REQUEST["token"])){
    session_destroy();
    require("template/login.php");
    exit;
}

if(!isset($_COOKIE['user'])){
    session_destroy();
    require("template/login.php");
    exit;
}

$username = $_COOKIE['user'];

if(!isset($_SESSION['token'])){
    require('template/login.php'); 
}else{
    if($_SESSION['token'] !== $_REQUEST['token']){
        session_destroy();
        require('template/login.php'); 
    }else{
        switch($_REQUEST['_route']){

            case"dashboard";
                $label =$admin_lang['dash_page'];
                require('template/dashboard.php');
            break;

            case"election";
                $sql='SELECT tbl_election.* FROM tbl_election ORDER BY tbl_election.election_id DESC';
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetchAll();
                $label =$admin_lang['election_page'];
                require('template/add.election.php');
            break;
    
            case"voter";
                $sql='SELECT tbl_candidate.* FROM tbl_candidate ORDER BY tbl_candidate.candidate_id DESC';
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetchAll();
                $label =$admin_lang['voter_page'];
                require('template/add.voter.php');
            break;
    
            case"candidate";
                $_SESSION['election_id'] = $_GET['election'];
                $sql='SELECT tbl_presidential_candidate.* FROM tbl_presidential_candidate WHERE election_id=:election ORDER BY tbl_presidential_candidate.presidential_id DESC LIMIT 0,6'; 
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':election', $_GET['election']);
                $stmt->execute();
                $res = $stmt->fetchAll();
                $label =$admin_lang['candidate_page'];
                require('template/add.candidate.php');
            break;

            case"vote-box";

                $sql ="SELECT tbl_voter_box.election_id, tbl_voter_box.candidate_id, count(tbl_voter_box.voter_id) AS total, tbl_presidential_candidate.presidential_name FROM tbl_voter_box INNER JOIN tbl_presidential_candidate ON tbl_voter_box.candidate_id = tbl_presidential_candidate.presidential_id WHERE tbl_voter_box.election_id = :election GROUP BY tbl_voter_box.candidate_id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':election', $_GET['election']);
                $stmt->execute();
                $res = $stmt->fetchAll();
                $label =$admin_lang['vote_box_page'];
                require('template/add.votebox.php');
            break;
    
            default:
                require('template/404.php');
    
        }
    }
}

?>