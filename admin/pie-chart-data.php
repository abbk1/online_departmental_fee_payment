<?php
include("functions.php");
// Example: Get this data from your database if needed
$response = [
    "labels" => ["100 level", "200 level", "300 level", "400 level"],
    "values" => [hundredLevel(), twoHundredLevel(), threeHundredLevel(), fourHhundredLevel()] // This could be dynamic
];

header('Content-Type: application/json');
echo json_encode($response);
