<!--indexE¸EEE€EE—EEE´E¬E¼EEheaderE€EE->
<!--indexE¸EEú±˜ìœ„ ú«´E”ì—EEE¬E©E˜ì–´ indexE°E€E¼EEú±˜ìœ„ ú«´E”ì— srcE€ Eˆìœ¼EE../EEE¬E©-->

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
      E”ë‰´úµ•ì¸
    </a>&nbsp;&nbsp;&nbsp;
    <a href="../form/inputNewGoods.php">
      EE’ˆE”ê°€
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
      print $_SESSION['userid']."EEúµ˜ìEú±©Eˆë‹¤.";?>
      <form action="../action/logout.php" method="post">
        <input type="submit" name="logout" value="Eœê·¸EE›ƒ">
      </form>
    <?php
    }
  ?>
</div>

  </body>
</html>
