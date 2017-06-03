<?php
  require('components/class/commands.php');
  $Commands = new Commands();
  $fullCommand = explode(" ", $_POST['command']);
  $command = $fullCommand[0];
  array_shift($fullCommand);
  $arguments = $fullCommand;
  switch(strtolower($command)){
    case "?":
    case "help":
      echo $Commands->help();
      break;
    case "ping":
      echo $Commands->ping();
      break;
    case "ls":
    case "list":
      if(!count($arguments) > 0){
        $arguments[0] = $_POST['currentDir'];
      }
      $Commands->listItems($arguments);
      break;
    case "read":
      $Commands->readItem($arguments);
      break;
    default:
      echo $Commands->invalidCommand($_POST['command']);
      break;
  }
?>
