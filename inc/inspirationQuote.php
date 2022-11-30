<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/Database.php');
include_once ($filepath . '/../classes/Common.php');

$common = new Common();
$db = new Database();

function getInspirationQuote()
{
    global $common, $db;
    $date = date('Y-m-d', time());
    $inspirationQuote = $common->select('daily_inspirations', "date='$date'");
    $inspirationQuote = $db->first($inspirationQuote);
    return $inspirationQuote['inspiration_quote'] ?? '';
}