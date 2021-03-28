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
			else{ echo "(沒有圖片)";}
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

  //time()
  //echo 'current Unix timestamp: '.time().'<br>'; //當前的 Unix 時間戳
  //echo '今天日期是: '.date('Y-m-d').'<br>';

//step 1: find actress
  //make query
  $myquery = "SELECT name,imgurl FROM actress";
  $is_first = True;
  if($actressName){
    $myquery = preprocess($myquery, $is_first);
    $myquery = $myquery." name LIKE '%{$actressName}%' ";
  }

  if($lage){
    $myquery = preprocess($myquery, $is_first);
    $lbirthtime = time() - (24*60*60*365)*$lage;
    $lbirthdate = date('Y-m-d',$lbirthtime);
    $myquery = $myquery." birthday <= '{$lbirthdate}' ";
  }
  if($uage){
    $myquery = preprocess($myquery, $is_first);
    $ubirthtime = time() - (24*60*60*365)*$uage;
    $ubirthdate = date('Y-m-d',$ubirthtime);
    $myquery = $myquery." birthday >= '{$ubirthdate}' ";
  }

	if($lheight){
		$myquery = preprocess($myquery, $is_first);
		$myquery = $myquery." (SUBSTRING_INDEX(height,'cm',1) >= '{$lheight}')";
	}	
	if($uheight){
		$myquery = preprocess($myquery, $is_first);
		$myquery = $myquery." (SUBSTRING_INDEX(height,'cm',1) <= '{$uheight}')";
	}	  

	if($lcup){
		$myquery = preprocess($myquery, $is_first);
		$myquery = $myquery." (cup_size >= '{$lcup}')";
	}	
	if($ucup){
		$myquery = preprocess($myquery, $is_first);
		$myquery = $myquery." (cup_size <= '{$ucup}')";
	}	 	
	if($lbust){
		$myquery = preprocess($myquery, $is_first);
		$myquery = $myquery." (SUBSTRING_INDEX(bust,'cm',1) >= '{$lbust}')";
	}	
	if($ubust){
		$myquery = preprocess($myquery, $is_first);
		$myquery = $myquery." (SUBSTRING_INDEX(bust,'cm',1) <= '{$ubust}')";
	}	 	

        if($lwaist){
		$myquery = preprocess($myquery, $is_first);
		$myquery = $myquery." (SUBSTRING_INDEX(waist,'cm',1) >= '{$lwaist}')";
	}	
	if($uwaist){
		$myquery = preprocess($myquery, $is_first);
		$myquery = $myquery." (SUBSTRING_INDEX(waist,'cm',1) <= '{$uwaist}')";
	}		
       if($lhips){
		$myquery = preprocess($myquery, $is_first);
		$myquery = $myquery." (SUBSTRING_INDEX(hips,'cm',1) >= '{$lhips}')";
	}	
	if($uhips){
		$myquery = preprocess($myquery, $is_first);
		$myquery = $myquery." (SUBSTRING_INDEX(hips,'cm',1) <= '{$uhips}')";
	}	
  if($is_first){
     echo "請輸入篩選資料！<br>";
  }
  else{
  echo htmlspecialchars($myquery, ENT_QUOTES, 'utf-8');
  //end make query
	  $actresses = array();
	  $urls = array();
		if ($catStmt = mysqli_prepare($conn, $myquery)) 
		{
			  $catStmt->execute();
			  $result = $catStmt->get_result();
			  // Fetch the result variables.
	      echo "共找到: ".$result->num_rows." 位女優".'<br>';
			  while ($row = $result->fetch_assoc()) 
			  {
			      // Store the results for later use.
			      //$_SESSION['name'] = $row['name'];
		  //$_SESSION['imgurl'] = $row['imgurl'];
						array_push($actresses, $row['name']);
		  array_push($urls, $row['imgurl']);
			  }
		}
	   
	//step 2: for each actress, do a query.
	  $i = 1;
	  $j = 0;
		$videoType = array("censored", "uncensored","vr");
	  foreach($actresses as $actor){
	    $counter = array();
	    echo "第{$i}位女優: {$actor}<br>";
		if($urls[$i-1]){
			print   '<tr>
						<td>
							<img name="myimage" src="'.$urls[$i-1].'" width="200" height="200" alt="word" />
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
	    $i = $i + 1;
	//step 3: for each type of video, find fanhao.

			for($j = 0; $j < 3; $j = $j+1 ){
				echo $videoType[$j].":<br>";
				$myquery = "SELECT DISTINCT fanhao,imgurl,title FROM (SELECT DISTINCT fanhao as number FROM actress_{$videoType[$j]}_revised WHERE actress LIKE '%{$actor}%') table1 JOIN {$videoType[$j]} on table1.number = {$videoType[$j]}.fanhao";
	      
	      //echo $myquery."<br>";
			if($result = $conn->query($myquery)){
			    show_result($result);
			    array_push($counter, $result->num_rows);
			    $result->free();
			}
			else{
			    echo "共找到 0 筆資料<br>"; 
			    array_push($counter, 0);   
			}
	    }

	    
	    echo "總計：有碼".$counter[0]."部，無碼".$counter[1]."部，VR".$counter[2]."部<br>";
	    unset($counter);
	    echo "============================================<br>";
	  }
  }

?>



