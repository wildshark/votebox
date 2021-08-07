<?php
try {
  $db = new PDO('sqlite:db/votebox2021.db'); 
}catch (Exception $e) {
  echo "Unable to connect";
  echo $e->getMessage();
  exit;
}

$config = json_decode(file_get_contents("config.json"),TRUE);
$template["header"] = $config['application'];
$polling_box_lang = $config['lang']['en_us']['polling_box'];
$admin_lang = $config['lang']['en_us']['administration'];