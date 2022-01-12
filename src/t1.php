<?php


$file_path = "t1.json";

$orders = json_decode(file_get_contents($file_path));

foreach($orders as $order) {
    echo $order->price;
}