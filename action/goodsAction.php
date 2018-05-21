<?php
//상품과 관련된 행위들
  session_start();
  class GoodsFunc{

    //상품과 수량을 받아 재고를 확인하고 업데이트하는 함수
    function SetUpdateBalance($nameMenu, $numMenu){
      require_once "../DB/mydb.php";

      //선택한 메뉴의 DB를 수정
      try {
        $pdo            = db_connect();
        $sql            = "SELECT * FROM goods WHERE menu_name = :menuname";

        $stt            = $pdo->prepare($sql);
        $stt->bindValue(':menuname',        $nameMenu);
        $stt->execute();
        $row            = $stt->fetch(PDO::FETCH_ASSOC);

        //현재 재고가 없다면
        if($row['menu_balance'] < 0){
          print "<script>alert('현재 재고가 없습니다.');</script>";
          print "<script>history.go(-1);</script>";
        }
        //주문수량 보다 재고량이 적다면
        else {
          if($row['menu_balance'] - $numMenu < 0){
            print "<script>alert('현재 재고가 없습니다.');</script>";
            print "<script>history.go(-1);</script>";
          }else {
            //주문 수량이 충분하다면
            $newbalance = $row['menu_balance'] - $numMenu;
            $sql        = "UPDATE goods SET menu_balance=:newbalance WHERE menu_name=:menuname";
            $stt        = $pdo->prepare($sql);
            $stt->bindValue(':newbalance',  $newbalance);
            $stt->bindValue(':menuname',    $nameMenu);
            $stt->execute();
          }
        }

      } catch (Exception $e) {
        $e->getMessage();
      }
    }

    //장바구니에 저장하는 함수
    function SetInputCart($nameMenu, $numMenu, $imgMenu, $priceMenu){
      try {
        require_once "../DB/mydb.php";

        $userId      = $_SESSION['userid'];
        $pdo         = db_connect();

        $inputTime   = Date('Y-m-d H:i:s',time());

        $sql         = "INSERT INTO inputCart(inputmenu_id,   inputmenu_name,   inputmenu_num,
                                              inputmenu_date, inputmenu_img,    inputmenu_price)";
        $sql        .= "VALUES ('$userId',      '$nameMenu',    '$numMenu',
                                '$inputTime',   '$imgMenu',     '$priceMenu')";

        $stt         = $pdo->prepare($sql);
        $stt->execute();

        // inputCart table(structure)
        // inputmenu_id varchar(20) NOT NULL,
        // inputmenu_name varchar(100) NOT NULL,
        // inputmenu_num int NOT NULL,
        // inputmenu_date datetime NOT NULL,
        // inputmenu_img varchar(100) NOT NULL
        // inputmenu_price int NOT NULL,
      } catch (Exception $e) {
        $e->getMessage();
      }
    }

    //재고량을 원래로 되돌린다.
    function backbalance($menu_name, $menu_num){
      require_once "../DB/mydb.php";
      try {
        //해당 상품의 현 재고량을 가져와서
        //매개변수로 넣은 수와 더하여 재고를 변경한다.
        //goods
        // menu_name varchar(100) NOT NULL,
      	// menu_img varchar(500) NOT NULL,
        // menu_price int NOT NULL,
      	// menu_balance int NOT NULL,
        // menu_calorie varchar(100) NOT NULL,
        // menu_explain varchar(500)
        $pdo = db_connect();
        $sql = "SELECT menu_balance FROM goods WHERE menu_name = :menuname";
        $stt = $pdo->prepare($sql);
        $stt->bindValue(':menuname',$menu_name);
        $stt->execute();
        $result = $stt->rowCount();

        if($result){
          $row = $stt->fetch(PDO::FETCH_ASSOC);
          $newbalance = $row['menu_balance'] + $menu_num;

          $sql = "update goods set menu_balance = $newbalance WHERE menu_name = '$menu_name'";

          $stt = $pdo->prepare($sql);
          $stt->execute();
        }
      } catch (Exception $e) {
        $e->getMessage();
      }
    }

    // //목록에서 선택한 물품을 삭제
    function deletehistory($buymenu_name, $buymenu_num){
      require_once "../DB/mydb.php";
      try {

        $id = $_SESSION['userid'];
        // buymenu_id varchar(20) NOT NULL,
        // buymenu_name varchar(100) NOT NULL,
        // buymenu_num int NOT NULL,
        // buymenu_date datetime NOT NULL,
        // buymenu_img varchar(500) NOT NULL,
        // buymenu_price int NOT NULL
        $pdo = db_connect();
        $sql = "DELETE FROM buyhistory WHERE buymenu_id = '$id' AND buymenu_name = '$buymenu_name' AND buymenu_num = $buymenu_num";

        $stt = $pdo->prepare($sql);
        $stt->execute();

      } catch (Exception $e) {
        $e->getMessage();
      }
    }

    //상품에 대한 정보를 받아서 상품을 새롭게 등록
    function SetNewGoods($nameMenu,     $imgMenu,   $priceMenu,   $balanceMenu,
                         $calorieMenu,  $explainMenu){
      require_once "../DB/mydb.php";
      try {
        $pdo    = db_connect();

        $sql    = "INSERT INTO goods(menu_name,     menu_img,     menu_price,
                                     menu_balance,  menu_calorie, menu_explain)";
        $sql   .= "VALUES('$nameMenu',      '$imgMenu',       '$priceMenu',
                          '$balanceMenu',   '$calorieMenu',   '$explainMenu')";

        $stt    = $pdo->prepare($sql);
        $stt->execute();
        $result = $stt->rowCount();

        if($result){
          print "<script>alert('상품 등록 완료')</script>";
          print "<script>location.replace('../index.php');</script>";
        }

        // goods tabel(structure)
        // menu_name varchar(100) NOT NULL,
        // menu_img varchar(500) NOT NULL,
        // menu_price int NOT NULL,
        // menu_balance int NOT NULL,
        // menu_calorie varchar(100) NOT NULL,
        // menu_explain varchar(500)

      } catch (Exception $e) {
        $e->getMessage();
      }
    }//end of SetNewGoods Function
  }//end of GoodsFunc Class
?>
