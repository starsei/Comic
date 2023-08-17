<?php

$txt = '../data/tender.txt';
$tarray = file($txt); //读取文件为数组
$cars = count($tarray);

$rand = rand(0,$cars);
$rand_output = $tarray[$rand];

$barragers = [
    'info' => $rand_output,
    // 'href' => 'http://www.yaseng.org'
];
// echo json_encode($barragers);
print_r($barragers); //输出随机文案
