<?php
/**
 * Created by PhpStorm.
 * User: licj
 * Date: 2020/2/7
 * Time: 19:21
 */

// 可参考：https://www.php.cn/php-weizijiaocheng-423422.html
$threeMonthsAgo = date("Y-m-d H:i:s",strtotime("-3 month"));
$oneYearsAgo = date("Y-m-d H:i:s",strtotime("-3 year"));
$defaultDate = date_format(date_create("2015-01-01"), "Y-m-d H:i:s");

echo $threeMonthsAgo;
echo "<br />";
echo strtotime($threeMonthsAgo);
echo "<br />";
echo date("Y-m-d H:i:s",strtotime("-1 year"));
echo "<br />";
echo strtotime($oneYearsAgo);
echo "<br />";
echo $defaultDate;
echo "<br />";
echo $threeMonthsAgo == $defaultDate ? "==" : "!=";

