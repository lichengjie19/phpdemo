<?php
/**
 * Created by PhpStorm.
 * User: licj
 * Date: 2020/2/8
 * Time: 12:20
 */

$str_demo = "";
for ($x=0; $x<=10; $x++) {
    $str_demo .= ",$x";
}
echo $str_demo;
echo "<br />";
echo substr($str_demo, 1);
echo "<br />";
echo "字符串长度: ".strlen($str_demo);

echo "<br />";
echo "空字符串长度: ".strlen("");