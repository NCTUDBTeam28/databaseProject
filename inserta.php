<?php
  if (isset($_POST["actressName"]))
    $actressName = $_POST['actressName'];
  else $actressName = NULL;

  if (isset($_POST["age"]))
    $age = $_POST['age'];
  else $age = NULL;

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
  $username = 'root';
  $password = 'y02260111';
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
    echo "[演員]:".$actressName."<br>";
  if ($age)
    echo "[年齡]:".$age."<br>";
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
  VALUES ($actressName,$age,$height,$cup,$bust,$waist,$hips)";
  if ($conn->query($myquery) === TRUE) {
  echo "New record created successfully";
  } 
  else {
  echo "Error: " . $myquery . "<br>" . $conn->error;
  }

//show result
//date is (space)2019-11-08
?>