<!doctype html>
<html lang="ja">
<head>
  <title>Selection</title>
  <meta charset="utf-8"/>
  <style>
  th{
    border:2px solid white;
    padding:5px;
    background-color:#ddf;
  }
  td{
    border:1px solid white;
    padding: 5px;
    background-color:#ddf;
  }
  body {margin:10px;}
  h1 {color:lightgray;font-size:48pt;margin: 0px; text-align:right;}
  p {font-size:14pt;}
  </style>
</head>
<?php
$dsn ='mysql:host=localhost; dbname=basketball; charset=utf8;';
$msg = "Location and starting time";
try {
  $pdo = new PDO($dsn,'root','');
  $sql = 'select * from schedule;';
  $stmt = $pdo->query($sql);
} catch (PDOException $e){
  $msg = $e ->getMessage();
  exit;
}

?>

<body>
  <h1>Selection</h1>
  <p>Which do you want to choose from?</p>
<p><a href="./location.php">Choose from location</a></p>
<p><a href="./time.php">Choose from time</a></p>


<table>
  <tr>
    <th>ID</th>
    <th>Location</th>
    <th>Time</th>
  </tr>
  <?php foreach($stmt as $item){
    if($st>=date('Y-m-d')){?>

  <tr>
    <th><?= $item['id'] ?></th>
    <td><?= $item['location'] ?></td>
    <td><?= $item['starting_time'] ?></td>
  </tr>
<?php  }  }?>

</table>
</body>
