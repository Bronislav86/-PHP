<?php

//функции fopen fread fclose

//fread (resource $handle , int $length) : string

$file = fopen('/lection/file.txt', 'rb');
$data = fread($file, 100);
fclose($file);
echo $data;