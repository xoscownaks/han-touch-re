<?php
//QNAのPOSTをDBに入れるため真ん中のphp
  require_once "QNAAction.php";

  $QNAAction  = new QNAAction();
  $title      = $_POST['title'];
  $content    = $_POST['content'];

  //新しいPOSTを登録
  $QNAAction->inputValueToDb($title,$content);
?>
