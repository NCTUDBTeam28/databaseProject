<?php
  function show_result($result){
		echo "共找到: ".$result->num_rows." 筆資料".'<br>';
		while ($girl = $result->fetch_assoc()) {
			echo $girl['title'].'<br>';
			print '<tr>
		          <td>
		             <img name="myimage" src="'.$girl['imgurl'].'" width="240" height="300" alt="word" />
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

  if (isset($_POST["category"]))
    $category = $_POST['category'];
  else $category = NULL;

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
echo "篩選條件:<br>";
foreach($category as $condition){
  echo $condition."<br>";

}
$myquery = "SELECT DISTINCT * FROM censored";
$is_first = True;
foreach($category as $condition){
  $myquery = preprocess($myquery, $is_first);
  $myquery = $myquery." title LIKE '%{$condition}%' ";

}


	echo "<br>======================<br>";
  echo "Query result:<br>";
	if ($is_first)
		echo "Showing all result......<br>";
  echo $myquery."<br>";
  echo "Query result:<br>";
  $result = $conn->query($myquery);
	

//show result
	if($result = $conn->query($myquery)){
		show_result($result);
		$result->free();
  }
	else{
		echo "共找到 0 筆資料，請換個條件再篩選一次... (◓Д◒)✄╰⋃╯<br>";   
  }


//date is (space)2019-11-08
?>

