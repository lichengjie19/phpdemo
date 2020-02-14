<?php
/**
 * Created by PhpStorm.
 * User: licj
 * Date: 2020/2/8
 * Time: 16:29
 */

//status表示：1-问卷合格  2-问卷不合格  3-大数据熟人  4-大数据生人 5-大数据待定

$threeMonthsAgo = strtotime(date("Y-m-d H:i:s",strtotime("-3 month")));
$oneYearsAgo = strtotime(date("Y-m-d H:i:s",strtotime("-1 year")));

$requestData = [
    "memberID" => "123",
    "friendID" => "234"
];

$memberID = $requestData['memberID'];
$friendID = $requestData['friendID'];

$bigdataResultList = [
    '234' => '1',
    '235' => '2',
    '236' => '3',
];

//$friendResultList = [
//    "isNotRelationList" => [
//        // 三个月内
////        "234" => "1575718210" // 2019-12-07 19:30:10
//        // 大于三个月
//        "234" =>"1560020994" // 2019-06-09 03:09:54
//    ]
//];


$friendResultList = [
    "isRelationList" => [
        "234" => "1575718210" // 2019-12-07 19:30:10
    ]
];

$status = 0;

// friend 没有
// todo 确认若没有, 返回格式是什么?
if (!array_key_exists("isNotRelationList", $friendResultList) && !array_key_exists("isRelationList", $friendResultList)) {
    // bigdata
    switch ($bigdataResultList[$friendID]) {
        case 1:
            $status = 3;
            break;
        case 2:
            $status = 4;
            break;
        case 3:
            $status = 5;
            break;
        default:
            $status = 5;
    }

} else {
    // 问卷合格 && 在一年内
    if (array_key_exists("isRelationList", $friendResultList) && $friendResultList['isRelationList'][$friendID] > $oneYearsAgo) {
        $status = 1;
    } elseif (array_key_exists("isRelationList", $friendResultList) && $friendResultList['isRelationList'][$friendID] < $oneYearsAgo) {
        // 问卷合格 && 不在一年内
        $status = 2;
    } else {
        // 问卷不合格
        $friendResult = $friendResultList['isNotRelationList'];

        // 三个月内
        if ($friendResult[$friendID] > $threeMonthsAgo) {;
            $status = 2;
        } else {
            // bigdata
            switch ($bigdataResultList[$friendID]) {
                case 1:
                    $status = 3;
                    break;
                case 2:
                    $status = 4;
                    break;
                case 3:
                    $status = 5;
                    break;
                default:
                    $status = 5;
            }
        }
    }

}

echo "status = $status";

