<!doctype html>
<html lang="ja">
<head>
  <title>Location</title>
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
  h2{font-size:16pt;}
  h3{font-size:14pt; margin:50px 0px 10px 0px;}
  </style>
</head>
<?php
$dsn ='mysql:host=localhost; dbname=basketball; charset=utf8;';
$msg = 'Location and starting time';

if(isset($_POST['location'])){
  $msg = 'Starting time for chosen location';
}


  try {
    $pdo = new PDO($dsn,'root','');
    $sql = 'select id, location, group_concat(distinct starting_time) from schedule group by location';
    $stmt = $pdo->query($sql);
    $cmd = 'select location from schedule group by location';
    $all_location = $pdo->query($cmd);
  } catch (PDOException $e){
    $msg = $e ->getMessage();
    exit;
  }

?>
<body>
  <h1>Location</h1>

  <p><?= $msg ?></p>
  <form action="" method="post">
    <p>Select locations: </p>
    <?php foreach($all_location as $each){ ?>
      <input type="checkbox" name="location[]" value="<?= $each['location'] ?>"><?=$each['location'] ?>
  <?php  } ?>
    <p><input type="submit" value="submit"></p>
</form>

  <table>
    <tr>
      <th>Location</th>
      <th>Time</th>
    </tr>
    <?php foreach($stmt as $item){
      if(isset($_POST['location'])){
        if(in_array($item['location'],$_POST['location'])){ ?>
          <tr>
            <td><?= $item['location'] ?></td>
            <td><ul>
              <?php foreach(explode(',',$item['group_concat(distinct starting_time)']) as $st){
                if($st>=date('Y-m-d')){?>
                <li><?=$st ?></li>
              <?php }}?>
            </ul></td>
          </tr>
  <?php  }
}else{ ?>
  <tr>

    <td><?= $item['location'] ?></td>
    <td><ul>
      <?php foreach(explode(',',$item['group_concat(distinct starting_time)']) as $st){
        if($st>=date('Y-m-d')){?>
        <li><?=$st ?></li>
      <?php }}?>
    </ul></td>
  </tr>
<?php }
    }?>

</table>
</body>
