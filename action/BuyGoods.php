<?php
//상품구입
  require_once "goodsAction.php";
  //입력한 값이 숫자인지 판단
  if(isset($_POST['inputNum']) && is_numeric($_POST['num'])){

    print "<script>alert('상품을 담았습니다.');</script>";

    $numMenu    = $_POST['num'];
    $nameMenu   = $_POST['menu_name'];
    $imgMenu    = $_POST['menu_img'];
    $priceMenu  = $_POST['menu_price'];
    $goods_func = new goodsfunc();

    //재고를확인하고 업데이트 하는 함수
    $goods_func->SetUpdateBalance($nameMenu, $numMenu);
    //장바구니에 저장
    $goods_func->SetInputCart($nameMenu, $numMenu, $imgMenu, $priceMenu);

    print "<script>history.go(-1);</script>";

  }else {

    print "<script>alert('숫자를 입력하세요');</script>";
    print "<script>history.go(-1);</script>";

  }

?>
