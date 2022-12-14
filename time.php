<!doctype html>
<html lang="ja">
<head>
  <title>Time</title>
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
$msg = "Haven't chose a date";
if(isset($_POST['date'])){
  $msg = $_POST['date'];
}
$dsn ='mysql:host=us-cdbr-east-06.cleardb.net; dbname=heroku_e68d59e330d9c08; charset=utf8;';
$msg = 'Choose a date';


if(isset($_POST['date'])){
  $date = $_POST['date'];
  $msg = "List for {$date}";
  try {
    $pdo = new PDO($dsn,'b2601c17bb7d3a','4ca3c775');
    $sql = "select id, location, date_format(starting_time, '%H:%i') as starting_time from schedule where date(starting_time)=:date";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':date',$date);
    $stmt->execute();
  } catch (PDOException $e){
    $msg = $e ->getMessage();
    exit;
  }
}
?>
<body>
  <h1>Time</h1>
  <p><?= $msg ?></p>
  <form action="" method="post">
  <input type="date" name="date"></input>
  <p><input type="submit" value="submit"></p>
</form>

<?php if(isset($sql)){ ?>
<table>
  <tr>
    <th>Location</th>
    <th>Starting Time</th>
  </tr>
  <?php foreach($stmt as $item){ ?>
  <tr>
    <td><?= $item['location'] ?></td>
    <td><?= $item['starting_time'] ?></td>
  </tr>
<?php  }
} ?>
</table>

</body>
