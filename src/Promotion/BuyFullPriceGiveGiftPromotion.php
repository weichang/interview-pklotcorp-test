<?php

namespace src\Promotion;


class BuyFullPriceGiveGiftPromotion extends Promotion
{

    public $price = 0;
    public $result = [];
    public $gift;

    public function buyFullPriceGiveGiftPromotion($price, $gift)
    {
        $this->price = $price;
        $this->gift = $gift;
        $this->name = "訂單滿 $this->price 元 送$this->gift ";
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
            $this->result['amount'] = 0;
            $this->result['products'] = [];
        }
    }
}