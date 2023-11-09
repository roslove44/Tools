<?php

define("ONES", [
    "zero", "un", "deux", "trois", "quatre", "cinq", "six", "sept", "huit", "neuf", "dix",
    "onze", "douze", "treize", "quatorze", "quinze", "seize", "dix-sept", "dix-huit", "dix-neuf"
]);

define("TENS", [
    "", "", "vingt", "trente", "quarante", "cinquante", "soixante", "soixante-dix", "quatre-vingt", "quatre-vingt-dix"
]);

function number_to_word(int $x)
{
    $result = "";
    if ($x < 20) {
        $result = ONES[$x];
    } elseif ($x < 100) {
        $tens = (floor($x / 10) == 7 || floor($x / 10) == 9) ? TENS[floor(($x / 10)) - 1] : TENS[floor(($x / 10))];
        $ones = ONES[$x % 10];
        $ones = (floor($x / 10) == 7 || floor($x / 10) == 9) ? ONES[10 + $x % 10] : $ones;
        $separator = ($x % 10 == 1) ? "-et-" : "-";
        $separator = ($x % 10 == 0) ? "" : $separator;
        $result = $tens . $separator . $ones;
    } elseif ($x < 1000) {
        $ones = ONES[floor($x / 100)];
        $ones = (floor($x / 100) == 1) ? "cent" : "$ones cent";
        $seconds = ($x % 100 > 0) ? number_to_word($x % 100) : "";

        $result = $ones . " " . $seconds;
    } elseif ($x < 1000000) {
        $ones = (floor($x / 1000) != 1) ? number_to_word(floor($x / 1000)) . " mille" : "mille";
        $seconds = ($x % 1000 > 0) ? number_to_word($x % 1000) : "";

        $result = $ones . " " . $seconds;
    } elseif ($x < 1000000000) {
        $ones = (floor($x / 1000000) > 1) ? number_to_word(floor($x / 1000000)) . " millions" : number_to_word(floor($x / 1000000)) . " million";
        $seconds = ($x % 1000000 > 0) ? number_to_word($x % 1000000) : "";

        $result = $ones . " " . $seconds;
    } elseif ($x < 1000000000000) {
        $ones = (floor($x / 1000000000) > 1) ? number_to_word(floor($x / 1000000000)) . " milliards" : number_to_word(floor($x / 1000000000)) . " milliard";
        $seconds = ($x % 1000000000 > 0) ? number_to_word($x % 1000000000) : "";

        $result = $ones . " " . $seconds;
    }

    $result = strval($result);
    return $result;
};

echo number_to_word(1895);
