<?php

session_start();

include("control/connection.php");
include("module/election.php");
include("module/ballot.box.php");
include("module/presidential.candidate.php");
include("module/candidate.php");

if(!isset($_REQUEST['submit'])){
    if(!isset($_REQUEST['_q'])){
        if(!isset($_REQUEST["_vote"])){
            if(!isset($_REQUEST['_route'])){
                require("voter/template/login.php"); 
            }else{
                require("admin/admin.php");
            }
        }else{
            if($_REQUEST["_vote"] === "true"){
                $presidential_candidate = presidential_candidate::fetch($db);
                if(!isset($image)){
                    $image ="assets/images/candidate.png";
                }
                $GLOBALS['voter_id'] = $_GET['candidate_id'];
                require("voter/template/main.php");
            }elseif($_REQUEST["_vote"] === "cast-vote"){

                $sql ='SELECT *,rowid "NAVICAT_ROWID" FROM "main"."tbl_voter_box" WHERE election_id=:election AND voter_id=:voter  LIMIT 0,1000';
                $stmt = $db->prepare($sql);

                $stmt->bindParam(':election', $_GET['election']);
                //$stmt->bindParam(':candidate', $_GET['candidate_hold']);
                $stmt->bindParam(':voter', $_GET['voter_hold']);
        
                $stmt->execute();

                if($stmt->fetchColumn() > 0){
                    echo"you have already cast your vote";
                    exit;
                }else{
                    $sql ='INSERT INTO "main"."tbl_voter_box"("vote_date", "election_id", "candidate_id", "voter_id") VALUES (:date,:election,:candidate,:voter)';
                    $stmt = $db->prepare($sql);
            
                    $stmt->bindParam(':date',date("Y-m-d H:i:s"));
                    $stmt->bindParam(':election', $_GET['election']);
                    $stmt->bindParam(':candidate', $_GET['candidate_hold']);
                    $stmt->bindParam(':voter', $_GET['voter_hold']);
            
                    if(false == $stmt->execute()){
                        $url['_vote'] ="failed";
                        $url['status'] ="failed";
                    }else{
                        $url['_vote'] ="successful";
                        $url['status'] ="successful";
                    }

                    header("location: ?".http_build_query($url));
                }
                
            }elseif($_REQUEST['_vote'] === "successful"){
                echo "voting is successful";
            }elseif($_REQUEST['_vote'] === "failed"){
                echo "voting is failed";
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