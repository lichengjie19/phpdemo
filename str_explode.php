<?php
$membersIds = "1,2,3,4,5,1,2,3,4,5,1,2,3,4,5";
// membersIds -> 限制每次最多查询200人
$membersIdsArr = explode(",", $membersIds);
if (count($membersIdsArr) > 10) {
    $error = [
        'returnCode' => 1,
        'returnMessage' => 'paramLengthTooLong',
        'returnUserMessage' => '限制每次最多查询200人',
    ];
    var_dump($error);
}

var_dump($membersIdsArr[0]);
var_dump($membersIdsArr[count($membersIdsArr) - 1]);;
?>