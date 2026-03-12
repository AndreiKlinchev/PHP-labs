<?php 
declare(strict_types =1);

$transactions = [
    [
        "id" => 1,
        "date" =>"2019-01-01",
        "amount" => 100.00,
        "description" => "Payment for groceries",
        "merchant" => "SuperMart",
    ],
    [
        "id" => 2,
        "date" =>"2020-02-15",
        "amount" => 75.50,
        "description" => "Dinner with friends",
        "merchant" => "Local Restaurant",
    ],
    [
        "id" => 3,
        "date" =>"2020-03-10",
        "amount" => 45.20,
        "description" => "Gas refill",
        "merchant" => "Fuel Station",
    ],
    [
        "id" => 4,
        "date" =>"2020-04-05",
        "amount" => 120.00,
        "description" => "Clothing purchase",
        "merchant" => "Fashion Store",
    ],
    [
        "id" => 5,
        "date" =>"2020-05-12",
        "amount" => 15.99,
        "description" => "Music subscription",
        "merchant" => "Streamify",
    ],
    [
        "id" => 6,
        "date" =>"2020-06-18",
        "amount" => 220.75,
        "description" => "Electronics purchase",
        "merchant" => "TechWorld",
    ],
    [
        "id" => 7,
        "date" =>"2020-07-03",
        "amount" => 60.00,
        "description" => "Gym membership",
        "merchant" => "FitClub",
    ],
    [
        "id" => 8,
        "date" =>"2020-08-21",
        "amount" => 30.40,
        "description" => "Book purchase",
        "merchant" => "BookStore",
    ],
    [
        "id" => 9,
        "date" =>"2020-09-14",
        "amount" => 12.50,
        "description" => "Coffee and snacks",
        "merchant" => "Cafe Corner",
    ],
    [
        "id" => 10,
        "date" =>"2020-10-02",
        "amount" => 89.99,
        "description" => "Online course",
        "merchant" => "EduPlatform",
    ],
    [
        "id" => 11,
        "date" =>"2020-11-11",
        "amount" => 150.00,
        "description" => "Furniture payment",
        "merchant" => "HomeStore",
    ],
    [
        "id" => 12,
        "date" =>"2020-12-24",
        "amount" => 200.00,
        "description" => "Christmas gifts",
        "merchant" => "GiftShop",
    ],
    [
        "id" => 13,
        "date" =>"2021-01-09",
        "amount" => 18.75,
        "description" => "Movie tickets",
        "merchant" => "CinemaCity",
    ],
    [
        "id" => 14,
        "date" =>"2021-02-14",
        "amount" => 95.30,
        "description" => "Valentine dinner",
        "merchant" => "Romantic Restaurant",
    ],
    [
        "id" => 15,
        "date" =>"2021-03-08",
        "amount" => 40.00,
        "description" => "Flower purchase",
        "merchant" => "Flower Shop",
    ],
    [
        "id" => 16,
        "date" => "2021-04-01",
        "amount" => 55.60,
        "description" => "Taxi rides",
        "merchant" => "CityTaxi",
    ],
    [
        "id" => 17,
        "date" => "2021-05-20",
        "amount" => 130.00,
        "description" => "New headphones",
        "merchant" => "AudioStore",
    ],
];


function calculateTotalAmount(array $transactions): ?float{
    
    if (empty($transactions)){return null;}

    $sum = 0;

    foreach($elem as $transactions){
        $sum+=$elem["amount"];
    }

    return $sum;
}

function findTransactionByDescription(string $descriptionPart): ?array{
    foreach ($elem as $transactions){
        if(str_contains($elem["description"], $descriptionPart)){
            return $elem;
        }

    }
}


function findTransactionById(int $id){
    function findInArr($el){
        return $el["id"] == $id;
    }

    return array_filter($transactions, function ($el) use ($id){
        return $el["id"] == $id;
    });
}
function daysSinceTransaction(string $date): int {
    return (int) (new DateTime($date))->diff(new DateTime())->days;
}
function addTransaction(int $id, string $date, float $amount, string $description, string $merchant): void{
    global $transactions;
    $transactions[] = [
        "id" => $id,
        "date" =>new DateTime($date), 
        "amount" => $amount, 
        "description" => $description, 
        "merchant" => $merchant,];
    }

function dateSort($a, $b){
    return $a["date"] <=> $b["date"];
}

function amountSort($a, $b){
    return $b["amount"] <=> $a["amount"] ;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transact Table</title>
</head>
<body>
    <table border='1'>
<thead>
    <tr>
        <td>ID</td>
        <td>Date</td>
        <td>Days for today</td>
        <td>Amount</td>
        <td>description</td>
        <td>Merchant</td>
    </tr>
</thead>

<tbody>
    <?php usort($transactions, "dateSort") ?> <!--transactions date sort -->
    
    <?php usort($transactions, "amountSort") ?> <!--transactions date sort -->
    
    <?php foreach ($transactions as $el): ?>
    <tr>
    <td><?= $el["id"];?></td>
    <td><?= $el["date"];?></td>
    <td><?= daysSinceTransaction($el["date"])?></td>
    <td><?= $el["amount"];?></td>
    <td><?= $el["description"];?></td>
    <td><?= $el["merchant"];?></td>
    
    </tr>
    <?php endforeach; ?>
</tbody>

</table>
</body>
</html>


































































































































































































































































































