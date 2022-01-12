<?php

namespace src\Promotion;

class BuySpecificPricePromotion extends Promotion
{
    public $price = 0;
    public $targetTag;
    public $result = [];
    public $percentOff;

    // 訂單滿 X 元折 Z %
    public function buySpecificPricePromotion($price, $percentOff)
    {
        $this->price = $price;
        $this->percentOff = $percentOff;
        $this->name = "訂單滿 $this->price 折 $this->percentOff %";
        $this->note = "";
    }

    public function process($orders)
    {
        $totalPrice = 0;
        foreach ($orders as $order) {
            $totalPrice += $order->price;
        }
        if ($totalPrice >= $this->price) {
            $this->result['name'] = $this->name;
            $this->result['note'] = $this->note;
            $amount = $totalPrice - ($totalPrice * ((100 - $this->percentOff) / 100));
            $this->result['amount'] = $amount;
            $this->result['products'] = [];
        }
    }

}