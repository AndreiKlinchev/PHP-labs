<?php

function empGraphic($arr, $workHours){
    $day = date("w");

    if (in_array($day, $arr)){
        echo $workHours;
    }
    else{
        echo "Выходной";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab3</title>
</head>

<style>

    table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    margin: 20px 0;
    background-color: #ffffff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
}

thead {
    background-color: #2c3e50;
    color: #ffffff;
}

th, td {
    padding: 12px 15px;
    text-align: left;
}

th {
    font-weight: 600;
    letter-spacing: 0.5px;
}

tbody tr {
    border-bottom: 1px solid #e0e0e0;
}

tbody tr:nth-child(even) {
    background-color: #f8f9fa;
}

tbody tr:hover {
    background-color: #e6f2ff;
    transition: 0.2s ease-in-out;
}

td:first-child,
th:first-child {
    text-align: center;
    width: 60px;
}
</style>
<body>
    <table>
        <tr>
            <td>№</td>
            <td>Имя фамилия</td>
            <td>График работы</td> 
        </tr>
        <tr>
            <td>1</td>
            <td>John Styles</td>
            <td><?php empGraphic([1,2,3], "8:00-12:00.") ?></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Jane Doe</td>
            <td>
                 <?php empGraphic([2,4,6], "12:00-16:00.") ?>

            </td>
        </tr>
        
        
    </table>

    

</body>
</html>

<?php

$a = 0;
$b = 0;

for ($i = 0; $i <= 5; $i++) {
    $a += 10;
    $b += 5;
    echo "Значение а: {$a}\tЗначение b: {$b}";
    echo "<br />";
}
echo "End of the loop: a = $a, b = $b";
echo "<br /><br />";


$a = 0;
$b = 0;
$wi = 0;
while ($wi <= 5){
    $a += 10;
    $b += 5;
    echo "Значение а: {$a}\tЗначение b: {$b}";
    echo "<br />";
    $wi++;
}
echo "End of the loop: a = $a, b = $b";

echo "<br /><br />";
$dwi = 0;

$a = 0;
$b = 0;
do{
    $a += 10;
    $b += 5;
    echo "Значение а: {$a}\tЗначение b: {$b}";
    echo "<br />";
    $dwi++;

}while($dwi <= 5);

echo "End of the loop: a = $a, b = $b";
