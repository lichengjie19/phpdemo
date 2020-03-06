<?php
/**
 * Created by PhpStorm.
 * User: licj
 * Date: 2020/2/12
 * Time: 17:54
 */


$membersIds = "";
$membersIdsArr = explode(",", $membersIds);
//var_dump($membersIdsArr);

//if (empty([])) echo '$a 为空' . "";
//if (!empty([1, 2])) echo '$a 不为空' . "";



$friendResultList = [
//    "isNotRelationList" => [
////        ["memberID" => "652218035093049947", "updateTime" => "2015-01-01 00:00:00"]
//    ],
];

$friendIDList = "[\"644663181288753369\"]";
var_dump($friendIDList);

echo "<br />";
var_dump(array_key_exists("123", null));

if (array_key_exists("123", null)) {
    echo "<br />";
    echo "if";
} else {
    echo "<br />";
    echo "else";
}


