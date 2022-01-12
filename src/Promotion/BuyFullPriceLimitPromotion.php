<?php


namespace src\Promotion;


class BuyFullPriceLimitPromotion extends Promotion
{
    public $price = 0;
    public $discountPrice = 0;
    public $result = [];
    public $limitNum;


    public function buyFullPriceLimitPromotion($price, $discountPrice, $limitNum)
    {
        $this->price = $price;
        $this->discountPrice = $discountPrice;
        $this->limitNum = $limitNum;
        $this->name = "訂單滿 $this->price 元折 $this->discountPrice 元，此折扣在全站總共只能套⽤ $this->limitNum 次";
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
            $this->result['amount'] = $this->discountPrice;
            $this->result['products'] = [];
        }
    }
}