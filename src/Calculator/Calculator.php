<?php
namespace src\Calculator;
use src\Promotion\BuySpecificProductPromotion;
use src\Promotion\BuySpecificPricePromotion;

class Calculator
{
    public function totalPrice($order_list){
        $totalPrice = 0;
        foreach ($order_list as $order) {
            $totalPrice += $order->price;
        }
        return $totalPrice;
    }

    public function calculatorPromotion($orderList){

        ## 特定商品滿 X 件折 Y 元 ##
        $totalDiscount = [];
        $buyMoreBoxesPromotion = new BuySpecificProductPromotion();
        $buyMoreBoxesPromotion->buySpecificProductPromotion("衛生紙", 6, 100);
        $buyMoreBoxesPromotion->process($orderList);
        array_push($totalDiscount, $buyMoreBoxesPromotion->result);

        ## 訂單滿 X 元折 Z % ##
        $buySpecificPricePromotion = new BuySpecificPricePromotion();
        $buySpecificPricePromotion->buySpecificPricePromotion(100, 2);
        $buySpecificPricePromotion->process($orderList);
        array_push($totalDiscount, $buySpecificPricePromotion->result);

        return $totalDiscount;
    }
}