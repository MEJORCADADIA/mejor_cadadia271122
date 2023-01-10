<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function dd(...$data) {
    echo '<pre>';
    var_dump(count($data) === 1 ? $data[0] : $data);
    echo '</pre>';
    die();
}