<?php

namespace src\Calculator;

use src\Promotion\BuyFullPriceGiveGiftPromotion;
use src\Promotion\BuyFullPriceLimitPromotion;
use src\Promotion\BuySpecificProductPromotion;
use src\Promotion\BuySpecificPricePromotion;

class Calculator
{
    public function totalPrice($order_list)
    {
        $totalPrice = 0;
        foreach ($order_list as $order) {
            $totalPrice += $order->price;
        }
        return $totalPrice;
    }

    public function calculatorPromotion($orderList)
    {

        ## 特定商品 滿 X 件折 Y 元
        $totalDiscount = [];
        $buyMoreBoxesPromotion = new BuySpecificProductPromotion();
        $buyMoreBoxesPromotion->buySpecificProductPromotion("衛生紙", 4, 100);
        $buyMoreBoxesPromotion->process($orderList);
        array_push($totalDiscount, $buyMoreBoxesPromotion->result);

        ## 訂單滿 X 元折 Z %
        $buySpecificPricePromotion = new BuySpecificPricePromotion();
        $buySpecificPricePromotion->buySpecificPricePromotion(100, 2);
        $buySpecificPricePromotion->process($orderList);
        array_push($totalDiscount, $buySpecificPricePromotion->result);

        # 訂單滿 X 元 贈送 特定商品
        $buyFullPriceGiveGiftPromotion = new BuyFullPriceGiveGiftPromotion();
        $buyFullPriceGiveGiftPromotion->buyFullPriceGiveGiftPromotion(500, "神秘福袋");
        $buyFullPriceGiveGiftPromotion->process($orderList);
        array_push($totalDiscount, $buyFullPriceGiveGiftPromotion->result);

        # 訂單滿 X 元折 Y 元，此折扣在全站總共只能套⽤ N 次
        $buyFullPriceLimitPromotion = new BuyFullPriceLimitPromotion();
        $buyFullPriceLimitPromotion->buyFullPriceLimitPromotion(500, 100, 1);
        $buyFullPriceLimitPromotion->process($orderList);
        array_push($totalDiscount, $buyFullPriceLimitPromotion->result);

        return $totalDiscount;
    }
}