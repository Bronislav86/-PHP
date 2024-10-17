<?php
// первая фаза
// $file = fopen('/lection/file.txt', 'rb');

// if ($file === false) {
//   echo("Файл невозможно открыть");
// } else {
//   $contents = "";
//   while (!feof($file)) {
//     $contents .=fread($file, 100);
//   }
//   fclose($file);
//   echo $contents;
// }
//вторая фаза
$address = '/lection/file.txt';

if (file_exists($address) && is_readable($address)) {
  $file = fopen($address, 'rb');

  $contents = "";
  while (!feof($file)) {
    $contents .=fread($file, 100);
  }
  fclose($file);
  echo $contents;
} else {
  echo("Файл невозможно открыть или он не существует");
}