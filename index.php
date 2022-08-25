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
$dsn ='mysql:host=us-cdbr-east-06.cleardb.net; dbname=heroku_e68d59e330d9c08; charset=utf8;';
$msg = "Location and starting time";
try {
  $pdo = new PDO($dsn,'b2601c17bb7d3a','4ca3c775');
  $sql = "select location, date_format(starting_time,'%Y-%m-%d %H:%i') as starting_time from schedule;";
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
    <th>Location</th>
    <th>Time</th>
  </tr>
  <?php foreach($stmt as $item){
    if($item['starting_time']>=date('Y-m-d')){?>

  <tr>
    <td><?= $item['location'] ?></td>
    <td><?= $item['starting_time'] ?></td>
  </tr>
<?php  }  }?>

</table>
</body>
