<!--index・ｸ・・・�・・乱・・・ｴ・ｬ・ｼ・・header・�・・->
<!--index・ｸ・・�ｱ們怱 �ｫｴ・肥乱・・・ｬ・ｩ・們牟 index・ｰ・�・ｼ・・�ｱ們怱 �ｫｴ・肥乱 src・� ・溢愍・・../・・・ｬ・ｩ-->

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
      ・罷俺�ｵ菩攤
    </a>&nbsp;&nbsp;&nbsp;
    <a href="../form/inputNewGoods.php">
      ・・宙・緋ｰ�
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
      print $_SESSION['userid']."・・�ｵ們・�ｱｩ・壱共.";?>
      <form action="../action/logout.php" method="post">
        <input type="submit" name="logout" value="・懋ｷｸ・・寃">
      </form>
    <?php
    }
  ?>
</div>

  </body>
</html>
