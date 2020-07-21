<?php
	function show_result($result){
		if($result->num_rows == 0){
			echo "<br>新成員~~<br><br>";
			return False;
		}
		else {
			echo "<br>重複了!!<br><br>";
			echo "<br>共找到: ".$result->num_rows." 筆資料".'<br>';
			while ($girl = $result->fetch_assoc()) {
				echo $girl['name']; 
				echo '<br>生日:';
				echo $girl['birthday']; 
				echo '<br>身高:';
				echo $girl['height']; 
				echo '<br>罩杯:';
				echo $girl['cup_size']; 
				echo '<br>三圍:';
				echo $girl['bust']; 
				echo '/';
				echo $girl['waist']; 
				echo '/';
				echo $girl['hips']; 
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
	function check_valid($myquery){
	  if(strpos($myquery,'>') !== False || strpos($myquery,'<') !== False ){
		echo "還想駭我網站阿(◓Д◒)✄╰⋃╯ 換個方式吧~~(輸入不應含有<或是>)<br>";
		return False;
	  }
	  else if(strpos($myquery,'\\') !== False || strpos($myquery,'\\\\') !== False){
		echo "還想駭我網站阿(◓Д◒)✄╰⋃╯ 換個方式吧~~(輸入不應含有\\或是\\\\)<br>";
		return False;
	  }
	  else if(  strpos($myquery,'//') !== False){
		echo "還想駭我網站阿(◓Д◒)✄╰⋃╯ 換個方式吧~~(輸入不應含有//)<br>";
		return False;
	  }
	  else if( strpos($myquery,'/') !== False ){
		echo "輸入不應含有/,請檢查生日格式.(還是你是想駭我網站(◓Д◒)✄╰⋃╯)<br>";
		return False;
	  }
	  else return True;
	}


  if (isset($_POST["actressName"]))
    $actressName = $_POST['actressName'];
  else $actressName = NULL;

  if (isset($_POST["birthday"]))
    $birthday = $_POST['birthday'];
  else $birthday = NULL;

  if (isset($_POST["height"]))
    $height = $_POST['height'];
  else $height = NULL;
  
  if (isset($_POST["cup"])){
    $cup = $_POST['cup'];
  }
  else $cup = NULL;
  
  if (isset($_POST["bust"])){
    $bust = $_POST['bust'];
  }
  else $bust = NULL;

  if (isset($_POST["waist"])){
    $waist = $_POST['waist'];
  }
  else $waist = NULL;

  if (isset($_POST["hips"])){
    $hips = $_POST['hips'];
  }
  else $hips = NULL;

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
echo "女優資訊<br>";
  $birthday = strval( $birthday );
  if ($actressName)
    echo "[演員]:".$actressName."<br>";
  if ($birthday)
    echo "[生日]:".$birthday."<br>";
  if ($height)
    echo "[身高]:".$height."<br>";
  if ($cup)
    echo "[罩杯]:".$cup."<br>";
  if ($bust)
    echo "[胸圍]:".$bust."<br>";
  if ($waist)
    echo "[腰圍]:".$waist."<br>";
  if ($hips)
    echo "[臀圍]:".$hips."<br>";

//query //insert into actress

  $myquery = "INSERT INTO actress (name,birthday,height,cup_size,bust,waist,hips) 
  VALUES ('".$actressName."',STR_TO_DATE('{$birthday}','%Y-%m-%d'),{$height},'".$cup."',{$bust},{$waist},{$hips})";
  echo htmlspecialchars($myquery, ENT_QUOTES, 'utf-8')."<br>";
  
  if(check_valid($myquery)===True){
	$mycheckquery = "SELECT * FROM actress WHERE name LIKE '%{$actressName}%' ";
	echo $mycheckquery."<br>";
	if($result = $conn->query($mycheckquery)){
		$is_duplicate = show_result($result);
		$result->free();
		if($is_duplicate)
			echo "The actress is already in javquery.";
		else{
			if ($conn->query($myquery) === TRUE) {
				echo "New record on actress created successfully.";
			} 
			else {
				echo "Error 請輸入完整資料!<br>";
				//echo $myquery."<br>";
				//echo $conn->error;
			} 
		}
	}
  }
//show result
//date is (space)2019-11-08
?>
