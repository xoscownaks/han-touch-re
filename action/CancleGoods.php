<?php
//구입한 상품을 취소
  require_once "goodsAction.php";

  $nameMenu     = $_POST['menu_name'];
  $numMenu      =  $_POST['menu_num'];

  $goods_func   = new goodsfunc();
  //재고량을 원래로 되돌리는 함수.
  $goods_func->backbalance($nameMenu, $numMenu);
  //담은 물품을 제거
  $goods_func->deletehistory($nameMenu, $numMenu);
  print "<script>history.go(-1)</script>";
?>
