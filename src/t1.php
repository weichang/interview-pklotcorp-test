<?php
require_once '../vendor/autoload.php';
use src\Order\Order;
use src\Calculator\Calculator;

$order = new Order();
$orderList = $order->getList();

$calculator = new Calculator();
$originPrice = $calculator->totalPrice($orderList);
$totalDiscount = $calculator->calculatorPromotion($orderList);


echo "購買商品: \n ";
echo "---------------------------------------------------\n";
$id = 1;
foreach ($orderList as $order) {
    echo "- $id, [$order->sku] $$order->price,$order->name,#{$order->tags[0]} \n";
    $id++;
}

echo "\n";
echo "折扣:" . "\n";
echo "--------------------------------------------------- \n";

$discountTotal = 0;
$totalPrice = $originPrice;
foreach ($totalDiscount as $r) {
    if (!empty($r)) {
        $totalPrice -= $r['amount'];
        $discountTotal += $r['amount'];
        $discountAmount = $r['amount'];
        $discountName = $r['name'];
        $discountNote = $r['note'];
        echo "- 折抵  $$discountAmount, ($discountName) \n";
        $id = 1;
        if (!empty($r['products'])) {
            foreach ($r['products'] as $product) {
                $sku = $product->sku;
                $price = $product->price;
                $name = $product->name;
                $tag = $product->tags[0];
                echo "* 符合: $id, [$sku] $$price $name #$tag \n";
                $id++;
            }
        }
    }

    echo "--------------------------------------------------- \n";
}
echo "--------------------------------------------------- \n";

echo "原始⾦額: $$originPrice \n";
echo "折扣⾦額: $$discountTotal \n";
echo "結帳金額: $$totalPrice \n";