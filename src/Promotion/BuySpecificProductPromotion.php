<?php

namespace src\Promotion;

class BuySpecificProductPromotion extends Promotion
{
    public $count = 0;
    public $discountPrice = 0;
    public $targetTag;
    public $result =[];

    // 特定商品滿 X 件折 Y 元
    public function buySpecificProductPromotion($targetTag, $count, $discountPrice)
    {
        $this->count = $count;
        $this->targetTag = $targetTag;
        $this->discountPrice = $discountPrice;
        $this->name = "特定商品滿" . $this->count . "件折" . $this->discountPrice . "元!";
        $this->note = "熱銷飲品限時優惠";
    }

    public function process($orders)
    {
        $match_product = [];
        foreach ($orders as $order) {
            if (in_array($this->targetTag, $order->tags)) {
                array_push($match_product,$order);
                if (count($match_product) == $this->count) {
                    $this->result['name'] = $this->name;
                    $this->result['note'] = $this->note;
                    $this->result['amount'] = $this->discountPrice;
                    $this->result['products'] = $match_product;
                }
            }
        }
    }

}