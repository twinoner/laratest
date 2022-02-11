<?php

function cmp($a, $b)
{
    if ($a[1] > $b[1]) {
        if ($a[2] > $b[2]) {
            return -1;
        }
        return -1;
    }
    return 1;
}

$products = [
    ['Milk', '1.25', 2],
    ['Eggs', '4.99', 1],
    ['Granulated sugar', '1.25', 1],
    ['Broccoli', '2.34', 3],
    ['Chocolate bar', '1.25', 5],
    ['Organic All-purpose flour', '4.99', 2]
];


usort($products, "cmp");

foreach ($products as $value) {
    $array = ['name' => $value[0]
    ,'price' => $value[1]
    ,'qty' => $value[2]
    ,'total' => $value[1]*$value[2]];
    print_r($array);
}