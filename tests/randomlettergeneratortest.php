<?php




function generateString(string $prefix = "", int $length = 4)
{

    $alphabets = [
        1 => "A",
        2 => "B",
        3 => "C",
        4 => "D",
        5 => "E",
        6 => "F",
        7 => "G",
        8 => "H",
        9 => "I",
        10 => "J",
        11 => "K",
        12 => "L",
        13 => "M",
        14 => "N",
        15 => "O",
        16 => "P",
        17 => "Q",
        18 => "R",
        19 => "S",
        20 => "T",
        21 => "U",
        22 => "V",
        23 => "W",
        24 => "X",
        25 => "Y",
        26 => "Z",
    ];

    $numbers = [
        1 => 0,
        2 => 1,
        3 => 2,
        4 => 3,
        5 => 4,
        6 => 5,
        7 => 6,
        8 => 7,
        9 => 8,
        10 => 9
    ];
    $generatedString = "";
    $generatedString .= $prefix;
    for ($x = 0; $x <= $length; $x++) {
        $generatedString .= $alphabets[rand(1, 26)] . $numbers[rand(1, 10)];
    }
    return $generatedString;
}

// $array = [];
// for ($x = 0; $x <= 70000; $x++) {
//     $string = generateString("PR");
//     if (!in_array($string, $array)) {
//         array_push($array, $string);
//     }
// }

// echo "<pre>";
// print_r($array);
// echo "</pre>";