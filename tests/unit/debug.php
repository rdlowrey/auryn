<?php

function bench()
{
    $now = microtime(true);
    $data = json_encode(array(
        'Runtime in milliseconds' => number_format(($now - \START_TIME) * 1000, 2),
        'Runtime in microseconds' => number_format(($now - \START_TIME), 5),
        'Peak memory in KB' => number_format(memory_get_peak_usage() / 1024, 2),
        'Included files' => count(get_included_files()),
    ));
    echo "\n<script>console.log($data);</script>";
}

/**
 * Debugging function, die after output
 */
function d()
{
    $string = '';
    foreach(func_get_args() as $value)
    {
        $string .= '<pre>';
        $string .= $value === NULL ? 'NULL' : (is_scalar($value) ? $value : print_r($value, TRUE));
        $string .= "</pre>\n";
    }
    echo $string;
    bench();
    die;
}

/**
 * Debug function, dont die after output
 */
function dump()
{
    $string = '';
    foreach(func_get_args() as $value)
    {
        $string .= '<pre>';
        $string .= $value === NULL ? 'NULL' : (is_scalar($value) ? $value : print_r($value, TRUE));
        $string .= "</pre>\n";
    }
    echo $string;
}
