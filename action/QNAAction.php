<?php
//QNA掲示板の機能を定義したPHP（DBとの連結）
  session_start();
  require_once "../DB/mydb.php";
  //QNA掲示板の作動に関する機能のクラス
  class QNAAction{

    //QNA掲示板に新しいPOSTを作成
    function inputValueToDb($title, $content){

      try {
        $pdo = db_connect();
        // qna_num int unsigned not null primary key auto_increment,
        // qna_title varchar(100) NOT NULL,
        // qna_content varchar(500) NOT NULL,
        // qna_date datetime NOT NULL,
        // qna_id varchar(50) NOT NULL,
        // qna_password varchar(50) NOT NULL
        $id = $_SESSION['userid'];
        $password = $_SESSION['password'];
        $date = Date('Y-m-d H:i:s');

        $sql = "INSERT INTO qnaboard(qna_num,   qna_title,  qna_content,
                                     qna_date,  qna_id,     qna_password)";
        $sql.=" VALUES (null, '$title', '$content', '$date', '$id','$password')";
        $stt = $pdo->prepare($sql);
        $stt->execute();
        $result = $stt->rowCount();

        if($result){
          print "<script>alert('・� ・ｰ・ｰ ・・｣・)</script>";
          print "<script>location.replace('../form/QNAform.php');</script>";
        }
      } catch (Exception $e) {
        $e->getMessage();
      }
    }

    //QNA掲示板の全てのpostを出力
    function showQnaMain(){
      try {
        $pdo = db_connect();

        $sql = "SELECT * FROM qnaboard ORDER BY qna_num desc";
  			$stt = $pdo->prepare($sql);
  			$stt->execute();
      } catch (Exception $e) {
        $e->getMessage();
      }
      return $stt;
    }

    //QNA掲示板のあるpostの詳しい情報見せる
    function showDetailQna($num){
      try {
        $pdo = db_connect();
        $sql = "SELECT * FROM qnaboard WHERE qna_num=$num";
        $stt = $pdo->prepare($sql);
        $stt->execute();
        $row = $stt->fetch(PDO::FETCH_ASSOC);

      } catch (Exception $e) {
        $e->getMessage();
      }
      return $row;
    }

    //ある掲示板のリプを見せる
    function comment($bno){
      try {
        $pdo = db_connect();
        // qna_num int NOT NULL,
        // comment varchar(500) NOT NULL,
        // comment_id varchar(50) NOT NULL,
        // commnet_date datetime NOT NULL
        $sql = "SELECT * FROM comment WHERE qna_num=$bno";
        $stt = $pdo->prepare($sql);
        $stt->execute();
        $row = $stt->fetchAll(PDO::FETCH_ASSOC);
      } catch (Exception $e) {
        $e->getMessage();
      }
      return $row;
    }
  }
?>
