<?php

	function check_valid($myquery){
	  if(strpos($myquery,'>') !== False || strpos($myquery,'<') !== False ){
		echo "還想駭我網站阿(◓Д◒)✄╰⋃╯ 換個方式吧~~(輸入不應含有<或是>)<br>";
		return False;
	  }
	  else if(strpos($myquery,'\\') !== False || strpos($myquery,'\\\\') !== False){
		echo "還想駭我網站阿(◓Д◒)✄╰⋃╯ 換個方式吧~~(輸入不應含有\\或是\\\\)<br>";
		return False;
	  }
	  else if(strpos($myquery,'//') !== False){
		echo "還想駭我網站阿(◓Д◒)✄╰⋃╯ 換個方式吧~~(輸入不應含有//)<br>";
		return False;
	  }
	  else return True;
	}
	function show_result($result){
		if($result->num_rows == 0){
			echo "<br>上新片~~<br><br>";
			return False;
		}
		else {
			echo "<br>重複了!!<br><br>";
			echo "共找到: ".$result->num_rows." 筆資料".'<br>';
			while ($girl = $result->fetch_assoc()) {
				echo $girl['title']; 
				echo '<br>';
				if($girl['imgurl']){
					print '<tr>
						  <td>
							 <img name="myimage" src="'.$girl['imgurl'].'" width="240" height="240" alt="word" />
						  </td>
						</tr>';
				}
				else{
					echo "沒有圖片.<br>";
					print '<tr>
							  <td>
							 <img name="myimage" src="https://truth.bahamut.com.tw/s01/202004/9cc414022cdb034b399614ce929147fa.JPG?w=1000" 
							width="100" height="100" alt="word" />
						  </td>
						</tr>';
				}
				echo "<br>";
			}
			return True;
		}
		
    }

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
  echo $myquery."<br>";
  //DELETE FROM  `censored` WHERE `fanhao` LIKE '%DB-2020%'

	if(check_valid($myquery)===True && check_valid($actressName)===True){ //check vaild
		$mycheckquery = "SELECT * FROM {$videoType} WHERE fanhao = '{$fanhao}' ";
		//echo $mycheckquery."<br>";
		if($result = $conn->query($mycheckquery)){ //check duplicate
			$video_is_duplicate = show_result($result);
			$result->free();
			if($video_is_duplicate)
				echo "The video is already in javquery.";
			else{ //let's go
				if ($conn->query($myquery) === TRUE) {
					echo "New record on video created successfully.<br>";
				} 
				else {
					echo "Error 演員資訊以外為必填，請輸入完整資料!<br>";
					//echo $myquery."<br>";
					//echo $conn->error;
				}
				if($actressName){
					echo "插入演員資訊:<br>";
					$myquery1 = "INSERT INTO actress_{$videoType}_revised (fanhao,actress) 
					VALUES ('".$fanhao."','".$actressName."')";
					echo $myquery1."<br>";
					if ($conn->query($myquery1) == TRUE) {
						echo "New record on actress info created successfully.";
					} 
					else {
						echo "Error:你做了什麼@@<br>";
						//echo $myquery."<br>";
						//echo $conn->error;
					}
				}
			}
		}
	}
//show result
//date is (space)2019-11-08
?>
