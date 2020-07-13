<?php
  function show_result($result){
		echo "共找到: ".$result->num_rows." 筆資料".'<br>';
		while ($girl = $result->fetch_assoc()) {
			echo $girl['title'].'<br>';
			print '<tr>
		          <td>
		             <img name="myimage" src="'.$girl['imgurl'].'" width="240" height="240" alt="word" />
		          </td>
		        </tr>';
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
			echo "Default:censored<br>";
  }
//show fliter
  echo "[篩選條件]<br>";
  if ($fanhao)
    echo "[番號]:".$fanhao."<br>";
  if ($ldate)
    echo "ldate =".$ldate."<br>";
  if ($udate)
    echo "udate =".$udate."<br>";
  echo "[影片種類]:cencored<br>";
  
  echo "<br>Query result:<br>";

//query //WHERE fanhao LIKE '%{$fanhao}%'
	$myquery = "SELECT * FROM {$videoType} ";
	$is_first = True;
	if($fanhao){
    $myquery = preprocess($myquery, $is_first);
    $myquery = $myquery." fanhao LIKE '%{$fanhao}%' ";
	}
	if($ldate){
		$myquery = preprocess($myquery, $is_first);
		$myquery = $myquery." (SUBSTRING_INDEX(date,'/',-1) >= ' ".$ldate."')";
	}	
	if($udate){
		$myquery = preprocess($myquery, $is_first);
		$myquery = $myquery." (SUBSTRING_INDEX(date,'/',-1) <= ' ".$udate."')";
	}	
	echo $myquery."<br>";
  $result = $conn->query($myquery);
	

	

//show result
  echo "共找到: " . $result->num_rows." 筆資料".'<br>';
  show_result($result);


//date is (space)2019-11-08
?>

