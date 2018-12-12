<?php

use Carbon\Carbon;

/**
 * 取得訂單編號
 *
 * @param Integer $serial 本日的訂單量
 * @return String 訂單編號
 */
function generateOrderId($serial)
{
    $dt = Carbon::now();
    return substr($dt->format('Ymd'), -6) . str_pad($serial, 3, '0', STR_PAD_LEFT);
}

/**
 * 計算訂單總金額
 *
 * @param Object $items
 * @return void
 */
function countOrderTotal($items)
{
    if (empty($items)) {
        return 0;
    }

    $sum = 0;

    foreach ($items as $item) {
        $temp = $item->price * $item->qty;
        $sum += $temp;
    }

    return $sum;
}
