<?php
/**
 * Created by PhpStorm.
 * User: licj
 * Date: 2020/2/7
 * Time: 10:54
 */
/**
 * list: {
 "      memberId":"status";//status表示：1-问卷合格  2-问卷不合格  3-大数据熟人  4-大数据生人 5-大数据待定
 * }[];
 */

$threeMonthsAgo = strtotime(date("Y-m-d H:i:s",strtotime("-3 month")));
$oneYearsAgo = strtotime(date("Y-m-d H:i:s",strtotime("-3 year")));


$membersIds = [
    '123', '124', '125', '126', '127'
];

$bigdataResultList = [
    '123' => '1',
    '124' => '2',
    '125' => '3',
];


$friendResultList = [
    "isNotRelationList" => [
        "123" => "1575718210" // 2019-12-07 19:30:10
    ],
	"isRelationList" => [
        "124" => "1578396610", // 2020-01-07 19:30:10
        "127" => "1551958210" // 2019-03-07 19:30:10
    ],
];

$isNotRelationList = $friendResultList['isNotRelationList'];
$isRelationList = $friendResultList['isRelationList'];

$resultList = [];
foreach ($membersIds as $key => $value) {
    // friend && bigdata 都没有
    if (!array_key_exists($value, $bigdataResultList) && !array_key_exists($value, $isNotRelationList) && !array_key_exists($value, $isRelationList)) {
        $resultList[$value] = 5;
        // todo 推到redis, 让大数据进行计算
        // key:    l:kin:wait_check_memberIds
        // value   {memberId1：memberId2,memberId3....}
        continue;
    }

    // bigdata 没有
    if (!array_key_exists($value, $bigdataResultList)) {
        // friend 不合格
        if (array_key_exists($value, $isNotRelationList)) {
            $resultList[$value] = 2;
            continue;
        }
        // friend 合格
        if (array_key_exists($value, $isRelationList)) {
            // 三个月内 ? 问卷合格 : 问卷不合格
            $resultList[$value] = $isRelationList[$value] > $threeMonthsAgo ? 1 : 2;
            continue;
        }
    }

    // bigdata 有
    // 1-熟人  2-生人  3-待定
    if (array_key_exists($value, $bigdataResultList)) {
        // 大数据是生人, 不再判断friend的问卷结果
        if ($bigdataResultList[$value] == 2) {
            $resultList[$value] = 4;
            continue;
        } elseif (!array_key_exists($value, $isNotRelationList) && !array_key_exists($value, $isRelationList)) {
            $resultList[$value] = $bigdataResultList[$value] == 1 ? 3 : 5;
            continue;
        }
        // friend 不合格
        if (array_key_exists($value, $isNotRelationList)) {
            $resultList[$value] = 2;
            continue;
        }
        // friend 合格
        if (array_key_exists($value, $isRelationList)) {
            // 三个月内 ? 问卷合格 : 问卷不合格
            $resultList[$value] = $isRelationList[$value] > $threeMonthsAgo ? 1 : 2;
            continue;
        }
    }

}

echo "<pre>";print_r($resultList);echo "<pre>";



