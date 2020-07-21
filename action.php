<?php
  function show_result($result){
		echo "共找到: ".$result->num_rows." 筆資料".'<br>';
		while ($girl = $result->fetch_assoc()) {
			echo $girl['title']; 
			echo '<br>';
			if($girl['imgurl']){
				print '<tr>
					  <td>
						 <img name="myimage" src="'.$girl['imgurl'].'" width="240" height="300" alt="word" />
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
  }
  function preprocess($myquery , &$is_first){
		if($is_first){
			$myquery = $myquery." WHERE ";
			$is_first = False;
		}
		else{
		  $myquery = $myquery." AND ";
		}
		return $myquery;
  }

  if (isset($_POST["fanhao"]))
    $fanhao = $_POST['fanhao'];
  else $fanhao = NULL;
  
  if (isset($_POST["title"]))
    $title = $_POST['title'];
  else $title = NULL;
  
  if (isset($_POST["ldate"])){
    $ldate = $_POST['ldate'];
  }
  else $ldate = NULL;

  if (isset($_POST["udate"])){
    $udate = $_POST['udate'];
  }
  else $udate = NULL;
	
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
echo "篩選條件<br>";
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
  if ($ldate)
    echo "ldate =".$ldate."<br>";
  if ($udate)
    echo "udate =".$udate."<br>";
  echo "[影片種類]:".$videoType."<br>";
  


//query //WHERE fanhao LIKE '%{$fanhao}%'
	$myquery = "SELECT DISTINCT * FROM {$videoType} ";
	$is_first = True;
	if($fanhao){
    	$myquery = preprocess($myquery, $is_first);
    	$myquery = $myquery." fanhao LIKE '%{$fanhao}%' ";
	}
	if($title){
    	$myquery = preprocess($myquery, $is_first);
    	$myquery = $myquery." title LIKE '%{$title}%' ";
	}
	if($ldate){
		$myquery = preprocess($myquery, $is_first);
		$myquery = $myquery." (SUBSTRING_INDEX(date,'/',-1) >= ' ".$ldate."')";
	}	
	if($udate){
		$myquery = preprocess($myquery, $is_first);
		$myquery = $myquery." (SUBSTRING_INDEX(date,'/',-1) <= ' ".$udate."')";
	}
	echo htmlspecialchars($myquery, ENT_QUOTES, 'utf-8');
	echo "<br>";
	echo "<br>======================<br>";
  echo "Query result:<br>";
	if ($is_first)
		echo "請輸入篩選資料！<br>";
  else{
		$result = $conn->query($myquery);
		

	//show result
		if($result = $conn->query($myquery)){
			show_result($result);
			$result->free();
		}
		else{
			echo "共找到 0 筆資料，請換個條件再篩選一次... (◓Д◒)✄╰⋃╯<br>";   
		}
  }

//date is (space)2019-11-08
?>

