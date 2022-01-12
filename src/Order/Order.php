<?php

namespace src\Order;

class Order
{
    function getList()
    {
        $file_path = "./tmp/order.json";
        return json_decode(file_get_contents($file_path));
    }
}