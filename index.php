<?php
  if(!empty($_POST['command'])){
    include('command.php');
  }else{
    include('main.php');
  }
?>
