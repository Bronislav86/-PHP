<?php
$users = [
  [
    'name' => 'Иван',
    'age' => 45,
  ],
  [
    'name' => 'Мария',
    'age' => 50,
  ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php foreach ($users as $user):?>
    <div>
      <b><? $user['name']?></b>: <? $user['age']?>
    </div>
  <?php endforeach; ?>
</body>
</html>