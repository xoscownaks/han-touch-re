<?php
//QNA게시판과 관련된 행위들
  session_start();

  //QNA게시판과 관련된 모든 실행 함수 보관
  class QNAAction{

    //QNA게시판에 새로운글 작성
    function inputValueToDb($title, $content){
      require_once "../DB/mydb.php";
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
          print "<script>alert('글 쓰기 완료')</script>";
          print "<script>location.replace('../form/QNAform.php');</script>";
        }
      } catch (Exception $e) {
        $e->getMessage();
      }
    }

    //QNA게시판에 등록된 모든 게시글 출력
    function showQnaMain(){
      require_once "../DB/mydb.php";
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

    //하나의 게시글에 대한 구체적인 내용 출력
    function showDetailQna($num){
      require_once "../DB/mydb.php";
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

    //게시글에 대한 댓글 출력
    function comment($bno){
      require_once "../DB/mydb.php";
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
