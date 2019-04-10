<?php
declare(strict_type = 1);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>HomeWork6_12</title>
</head>
<body>
<h2>Сallback функции</h2>
<p>Для всех заданий:</p>
<ul style="list-style-type: none;">
    <li>- использовать array_filter или array_map;</li>
    <li>- на входе для всех заданий, дан массив:<br>
        [<br>
        &nbsp;&nbsp;&nbsp;&nbsp;['name' => 'Yan', 'salary' => '1200', 'work_hours' => 180],<br>
        &nbsp;&nbsp;&nbsp;&nbsp;['name' => 'Barda', 'salary' => '2150', 'work_hours' => 160],<br>
        &nbsp;&nbsp;&nbsp;&nbsp;['name' => 'Piter', 'salary' => '1500', 'work_hours' => 160],<br>
        &nbsp;&nbsp;&nbsp;&nbsp;['name' => 'Alex', 'salary' => '3340', 'work_hours' => 167],<br>
        &nbsp;&nbsp;&nbsp;&nbsp;['name' => 'Deiv', 'salary' => '1700', 'work_hours' => 176],<br>
        &nbsp;&nbsp;&nbsp;&nbsp;['name' => 'Bob', 'salary' => '1150', 'work_hours' => 182],<br>
        &nbsp;&nbsp;&nbsp;&nbsp;['name' => 'Claus', 'salary' => '2810', 'work_hours' => 155],<br>
        &nbsp;&nbsp;&nbsp;&nbsp;['name' => 'Lina', 'salary' => '1600', 'work_hours' => 169],<br>
        &nbsp;&nbsp;&nbsp;&nbsp;['name' => 'Rod', 'salary' => '2780', 'work_hours' => 191],<br>
        &nbsp;&nbsp;&nbsp;&nbsp;['name' => 'Kristy', 'salary' => '2180', 'work_hours' => 144],<br>
        &nbsp;&nbsp;&nbsp;&nbsp;['name' => 'Ron', 'salary' => '1670', 'work_hours' => 157],<br>
        ]
    </li>
    <li>- выводить результирующий массив в табличном виде.</li>
</ul>
<ul style="list-style-type: none;">
    <li>1) Всем сотрудникам у кого ЗП меньше 1600 добавить 100.</li>
    <li>2) Всем сотрудникам кто работал больше 180 часов, добавить премию 20%.</li>
    <li>3) Вывести всех сотрудников которые отработали меньше 160 часов.</li>
    <li>4) Вывести всех сотрудников у которых ЗП меньше 2000.</li>
</ul>
<?php
//Обьявляем массив который будет использоваться для всех заданий на входе
$arDataPeople = [
    ['name' => 'Yan', 'salary' => '1200', 'work_hours' => 180],
    ['name' => 'Barda', 'salary' => '2150', 'work_hours' => 160],
    ['name' => 'Piter', 'salary' => '1500', 'work_hours' => 160],
    ['name' => 'Alex', 'salary' => '3340', 'work_hours' => 167],
    ['name' => 'Deiv', 'salary' => '1700', 'work_hours' => 176],
    ['name' => 'Bob', 'salary' => '1150', 'work_hours' => 182],
    ['name' => 'Claus', 'salary' => '2810', 'work_hours' => 155],
    ['name' => 'Lina', 'salary' => '1600', 'work_hours' => 169],
    ['name' => 'Rod', 'salary' => '2780', 'work_hours' => 191],
    ['name' => 'Kristy', 'salary' => '2180', 'work_hours' => 144],
    ['name' => 'Ron', 'salary' => '1670', 'work_hours' => 157],
];


/**
 * Функция для печати результирующих массивов в табличном виде по заданиям
 *
 * @param array $arValues
 * @param bool $numberInOrder
 */
function printArResultInTable(array $arValues, bool $numberInOrder = false) {
    echo "<table  class='table table-hover' style='width: 25%;'><thead class='thead-dark'>";
    if ($numberInOrder) {
        printf("<th scope='col'>%s</th>", "№п./п.");
    }
    reset($arValues);
    foreach (current($arValues) as $nameColumn => $value) {
        printf("<th scope='col'>%s</th>", mb_strtoupper($nameColumn));
    }
    echo "</thead><tbody>";
    $count = 1;
    foreach ($arValues as $key => $arValue) {
        echo "<tr>";
        if ($numberInOrder) {
            printf("<th scope='row'>%s</th>", $count);
            $count++;
        }
        foreach ($arValue as $nameColumn => $value) {
            printf("<td>%s</td>", $value);
        }
        echo "</tr>";
    }
    echo "</tbody></table>";
}

echo "<b>Задание 1):</b><br>";
/**
 * Callback функция для задания 1 для тех у кого ЗП меньше 1600 прибавляет к ЗП еще 100
 *
 * @param array $arValues
 * @return array
 */
function salaryPlus(array $arValues) {
    if (is_string($arValues['salary'])) {
        $arValues['salary'] = (int)$arValues['salary'];
    }

    if ((int)($arValues['salary']) < 1600) {
        $arValues['salary'] = $arValues['salary'] + 100;
    }

    return $arValues;
}
$arSalaryPlus = array_map('salaryPlus', $arDataPeople);
printArResultInTable($arSalaryPlus,true);
echo "<br><br>";

echo "<b>Задание 2):</b><br>";
/**
 * Callback функция для задания 2 для тех у кого рабочих часов больше 180 добавляем премию 20%
 *
 * @param array $arValues
 * @return array
 */
function hoursBounty(array $arValues) {
    if (is_string($arValues['salary'])) {
        $arValues['salary'] = (int)$arValues['salary'];
    }

    if ($arValues['work_hours'] > 180) {
        $arValues['salary'] = $arValues['salary'] * 0.2;
    }
    return $arValues;
}
$arHoursBounty = array_map('hoursBounty', $arDataPeople);
printArResultInTable($arHoursBounty,true);
echo "<br><br>";

echo "<b>Задание 3):</b><br>";
/**
 * Callback функция для задания 3 которая отбирает сотрудников у которых ЗП меньше 2000
 *
 * @param array $arValues
 * @return array
 */
function lessHours(array $arValues) {
    if ($arValues['work_hours'] < 160) {
        return $arValues;
    }
}
$arLessHours = array_filter($arDataPeople, 'lessHours');
printArResultInTable($arLessHours,true);
echo "<br><br>";

echo "<b>Задание 4):</b><br>";
/**
 * Callback функция для задания 4 которая отбирает сотрудников которые отработали меньше 160 часов
 *
 * @param array $arValues
 * @return array
 */
function smallSalary(array $arValues) {
    if (is_string($arValues['salary'])) {
        $arValues['salary'] = (int)$arValues['salary'];
    }

    if ($arValues['salary'] < 2000) {
        return $arValues;
    }
}
$arSmallSalary = array_filter($arDataPeople, 'smallSalary');
printArResultInTable($arSmallSalary,true);
echo "<br><br>";
?>
</body>
</html>