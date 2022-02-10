<?php

function get_lines(string $file_name): array
{
    $myfile = fopen(__DIR__ . "\\" . $file_name, "r") or die("Unable to open file!");

    $lines = [];
    while (!feof($myfile)) {
        $line = trim(fgets($myfile));
        // foreach (preg_split('#,[^(\s)]#', $line) as $item) {
        //     array_push($lines, $item);
        // }

        if ($line) array_push($lines, $line);
    }
    fclose($myfile);

    return array_unique($lines);
}