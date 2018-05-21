<?php
//새로운 상품을 담은다
  require_once "../DB/mydb.php";
  require_once "goodsAction.php";

  $menu_name = $_POST['menu_name'];

  //새로운 상품에 대한 정보를 받아와 기존의 상품과 비교하여
  //같은 이름의 상품이 있는 것을 확인, 상품의 이미지를 저장 및 상품생성함수 실행
  try {
    $pdo = db_connect();
    $sql = "SELECT * FROM goods WHERE menu_name='$menu_name'";
    $stt = $pdo->prepare($sql);
    $stt->execute();
    $result = $stt->rowCount();
    //기존의 DB를 가져와 해당하는 상품이 이미 있다면
    if($result){
      print "<script>alert('이미 존재하는 상품입니다.')</script>";
      print "<script>history.go(-1)</script>";
    }//새로운 상품이라면
    else {
      if(isset($_FILES['uploadfile']) && !$_FILES['uploadfile']["error"]){
        //업로드시 허용할 이미지의 확장자들
        $imageKind = array ('image/jpeg', 'image/JPG', 'image/jpg', 'image/PNG', 'image/png');
        //imageKind내에 업로드한 파일의 타입이 있는지 확인
        if(in_array($_FILES['uploadfile']['type'], $imageKind)){
          $filename = $_FILES['uploadfile']['name'];
          $filepath = $_FILES['uploadfile']['tmp_name'];
          $location = "../src/".$filename;
          move_uploaded_file($filepath,$location);

          $menu_name = $_POST['menu_name'];
          $menu_img = "src/".$filename;

        }//end of if(in_array($_FILES['uploadfile']['type'], $imageKind)
        else {
          print "<script>alert('파일이 올바르지 않습니다.')</script>";
          print "<script>history.go(-1)</script>";
        }//end of if(in_array($_FILES['uploadfile']['type'], $imageKind) else
      }//end of if(isset($_FILES['uploadfile']) && !$_FILES['uploadfile']["error"])
    }//end of else
    $menu_price = $_POST['menu_price'];
    $menu_img = "src/".$filename;
    $menu_balance = $_POST['menu_balance'];
    $menu_calorie = $_POST['menu_calorie']."kcal";
    $menu_explain = $_POST['menu_explain'];

    $goodsfunc = new goodsfunc();
    $goodsfunc->inputNewGoods($menu_name,$menu_img,$menu_price,$menu_balance,$menu_calorie,$menu_explain);

  } catch (Exception $e) {
    $e->getMessage();
  }//end of try~catch


?>
