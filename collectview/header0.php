<!--index�E��E�E�E��E�E���E�E�E��E��E��E�Eheader�E��E�E->
<!--index�E��E�E���위 ����E�에�E�E�E��E��E�어 index�E��E��E��E�E���위 ����E�에 src�E� �E�으�E�E../�E�E�E��E�-->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      input[type=submit]{
        padding: 3px 15px 3px 15px;
      }
      a{
          text-decoration:none;
      }
    </style>
  </head>
  <body>
    <div id="logo">
  <a href="../index.php">
    <img src="../src/logo.png"/>
  </a>
</div>
<div id="join">
<?php
  if(!isset($_SESSION['userid'])){
?>
  <a href="../form/join_form.php">
    <img src="../src/join.png"/>
  </a>
<?php
  }else{
    ?>
    <a href="../form/showDetailBuygoods.php">
      �E�뉴���인
    </a>&nbsp;&nbsp;&nbsp;
    <a href="../form/inputNewGoods.php">
      �E�E���E�가
    </a>
<?php
  }
?>
</div>
<div id="login">
<?php
  if(!isset($_SESSION['userid'])){
?>
      <a href="../form/login_form.php">
        <img src="../src/login.png"/>
      </a>
<?php
} else{
      print $_SESSION['userid']."�E�E����E����E�다.";?>
      <form action="../action/logout.php" method="post">
        <input type="submit" name="logout" value="�E�그�E�E��">
      </form>
    <?php
    }
  ?>
</div>

  </body>
</html>
