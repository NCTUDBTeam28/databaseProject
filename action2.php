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

  if (isset($_POST["actressName"]))
    $actressName = $_POST['actressName'];
  else $actressName = NULL;
//age
  if (isset($_POST["lage"]))
    $lage = $_POST['lage'];
  else $lage = NULL;
  
  if (isset($_POST["uage"])){
    $uage = $_POST['uage'];
  }
  else $uage = NULL;
//height
  if (isset($_POST["lheight"])){
    $lheight = $_POST['lheight'];
  }
  else $lheight = NULL;
	
  if (isset($_POST["uheight"]))
    $uheight = $_POST['uheight'];
  else $uheight = NULL;
//cup
  if (isset($_POST["lcup"]))
    $lcup = $_POST['lcup'];
  else $lcup = NULL;
  
  if (isset($_POST["ucup"])){
    $ucup = $_POST['ucup'];
  }
  else $ucup = NULL;
//bust
  if (isset($_POST["lbust"])){
    $lbust = $_POST['lbust'];
  }
  else $lbust = NULL;
	
  if (isset($_POST["ubust"]))
    $ubust = $_POST['ubust'];
  else $ubust = NULL;
//waist
  if (isset($_POST["lwaist"]))
    $lwaist = $_POST['lwaist'];
  else $lwaist = NULL;
  
  if (isset($_POST["uwaist"])){
    $uwaist = $_POST['uwaist'];
  }
  else $uwaist = NULL;
//hips
  if (isset($_POST["lhips"])){
    $lhips = $_POST['lhips'];
  }
  else $lhips = NULL;
	
  if (isset($_POST["uhips"]))
    $uhips = $_POST['uhips'];
  else $uhips = NULL;


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
  if ($actressName)
    echo "[女優名]:".$actressName."<br>";
  if ($lage)
    echo "[lage]:".$lage."<br>";
  if ($lage)
    echo "[uage]:".$uage."<br>";
  if ($lheight)
    echo "lheight =".$lheight."<br>";
  if ($uheight)
    echo "uheight =".$uheight."<br>";

  if ($lcup)
    echo "[lcup]:".$lcup."<br>";
  if ($ucup)
    echo "[ucup]:".$ucup."<br>";
  if ($lbust)
    echo "[lbust]:".$lbust."<br>";
  if ($ubust)
    echo "[ubust] =".$ubust."<br>";

  if ($lwaist)
    echo "[lwaist]:".$lwaist."<br>";
  if ($uwaist)
    echo "[uwaist]:".$uwaist."<br>";
  if ($lhips)
    echo "[lhips]:".$lhips."<br>";
  if ($uhips)
    echo "[uhips] =".$uhips."<br>";
  echo "======================";
  echo "<br>Query result:<br>";
	

//show result

//  show_result($result);



?>
