<?php
try {
  $db = new PDO('sqlite:db/votebox2021.db'); 
}catch (Exception $e) {
  echo "Unable to connect";
  echo $e->getMessage();
  exit;
}
