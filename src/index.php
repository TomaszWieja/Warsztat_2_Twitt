<?php



function printLoop ($repetitions) {
    for ($i = 0; $i < $repetitions; $i++) {
    echo ("Wartość i1 = $i <br>");
    }
    for ($i = 0; $i < $repetitions; $i++) {
    echo ("Wartość i2 = $i <br>");
    }
    for ($i = 0; $i < $repetitions; $i++) {
    echo ("Wartość i3 = $i <br>");
    }
    for ($i = 0; $i < $repetitions; $i++) {
    echo ("Wartość i4 = $i <br>");
    }
}

printLoop(20);