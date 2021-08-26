<?php

session_start();
setcookie("clock",time(), time()+3600); 

include("control/connection.php");
include("module/election.php");
include("module/ballot.box.php");
include("module/presidential.candidate.php");
include("module/candidate.php");

if(!isset($_REQUEST['submit'])){
    if(!isset($_REQUEST['_q'])){
        if(!isset($_REQUEST["_vote"])){
            if(!isset($_REQUEST['_route'])){
                $label = $polling_box_lang['login_page'];
                require("polling_box/template/login.php"); 
            }else{
                require("admin/admin.php");
            }
        }else{
            if($_REQUEST["_vote"] === "true"){

                $presidential_candidate = presidential_candidate::fetch($db);
                if(!isset($image)){
                    $image ="assets/images/candidate.png";
                }
                $url_qry = $_SERVER['REQUEST_URI'];
                $GLOBALS['voter_id'] = $_GET['candidate_id'];
                $label = $polling_box_lang['polling_page'];
                require("polling_box/template/main.php");

            }elseif($_REQUEST["_vote"] === "cast-vote"){

                $sql ='SELECT *,rowid "NAVICAT_ROWID" FROM "main"."tbl_voter_box" WHERE election_id=:election AND voter_id=:voter  LIMIT 0,1000';
                $stmt = $db->prepare($sql);

                $stmt->bindParam(':election', $_GET['election']);
                $stmt->bindParam(':voter', $_GET['voter_hold']);
        
                $stmt->execute();

                if($stmt->fetchColumn() > 0){
                    $label = $polling_box_lang['exist_page']; 
                    require("polling_box/template/exist.php");
                    exit;
                }else{
                    $date = date("Y-m-d H:i:s");
                    $election = $_GET['election'];
                    $candidate = $_GET['candidate_hold'];
                    $vote = $_GET['voter_hold'];

                    $sql ='INSERT INTO "main"."tbl_voter_box"("vote_date", "election_id", "candidate_id", "voter_id") VALUES (:date,:election,:candidate,:voter)';
                    $stmt = $db->prepare($sql);
            
                    $stmt->bindParam(':date',$date);
                    $stmt->bindParam(':election', $election);
                    $stmt->bindParam(':candidate', $candidate);
                    $stmt->bindParam(':voter', $vote);
            
                    if(false == $stmt->execute()){
                        $label = $polling_box_lang['failed_page']; 
                       require('polling_box/template/failed.php');
                    }else{
                        $label = $polling_box_lang['success_page'];
                       require('polling_box/template/successful.php');
                    }
                } 
            }
        }
    }else{

        $q = $_REQUEST['_q'];
        $candidate = candidate::search($db,$q);
        if($candidate == false){
            $url ="?page=main";
        }else{
            $url = "?_vote=true&".http_build_query($candidate);    
        }
        header("location:". $url);
    }
}else{
    require('admin/module.php');
}

?>