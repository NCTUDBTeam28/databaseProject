<?php
  if (isset($_POST["fanhao"]))
    $fanhao = $_POST['fanhao'];
  else $fanhao = NULL;
  
  if (isset($_POST["title"]))
    $title = $_POST['title'];
  else $title = NULL;

  if (isset($_POST["actressName"]))
    $actressName = $_POST['actressName'];
  else $actressName = NULL;
  
  if (isset($_POST["date"])){
    $date = $_POST['date'];
  }
  else $date = NULL;
  
  if (isset($_POST["videoType"]))
    $v = $_POST['videoType'];
  else $v = NULL;

  $serve = 'localhost';
  $username = 'ben';
  $password = '00000000';
  $dbname = 'av';
  $conn = new Mysqli($serve,$username,$password,$dbname);
  if($conn->connect_error){
    die('connect error:'.$conn->connect0_errno);
    echo "failed";
  }
  $conn->set_charset('UTF-8'); // 設定資料庫字符集
//show fliter
  
echo "======================<br>";
echo "影片資訊<br>";
  switch($v){
    case 1:
      $videoType = 'censored';
      break;
    case 2:
      $videoType = 'uncensored';
      break;
    case 3:
      $videoType = 'vr';
      break;
    default:
      $videoType = 'censored';
      echo "(Default videoType censored)<br>";
  }

  if ($fanhao)
    echo "[番號]:".$fanhao."<br>";
  if ($title)
    echo "[片名]:".$title."<br>";
  if ($actressName)
    echo "[演員]:".$actressName."<br>";
  if ($date)
    echo "[date]:".$date."<br>";
  echo "[影片種類]:".$videoType."<br>";
  echo "<br>Query result:<br>";

//query //insert into video type

  $myquery = "INSERT INTO {$videoType} (fanhao,title,date) 
  VALUES ('".$fanhao."','".$title."',{$date})";
  
  if ($conn->query($myquery) === TRUE) {
    echo "New record created successfully";
  } 
  else {
    echo "Error:<br>";
	echo htmlspecialchars($myquery, ENT_QUOTES, 'utf-8');
	echo $conn->error;
  }
//query insert into videotype_reverse
  if($actressName)
	  $myquery1 = "INSERT INTO actress_{$videoType}_revised (fanhao,actress) 
	  VALUES ('".$fanhao."','".$actressName."')";
	  if ($conn->query($myquery1) == TRUE) {
	  echo "New record created successfully";
	  } 
	  else {
		echo "Error:<br>";
		echo htmlspecialchars($myquery, ENT_QUOTES, 'utf-8');
		echo $conn->error;
	  }
//show result
//date is (space)2019-11-08
?>
