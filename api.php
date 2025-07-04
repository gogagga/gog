<?php
require "config.php";

header("Content-Type: application/json");

if (!isset($_GET["object_id"])) {
    echo json_encode(["error" => "object_id required"]);
    exit;
}

$object_id = $_GET["object_id"];

$dates = [];
$today = new DateTime();
$end = (new DateTime())->modify("+30 days");
$period = new DatePeriod($today, new DateInterval("P1D"), $end);

foreach ($period as $date) {
    $d = $date->format("Y-m-d");

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM bookings WHERE object_id = ? AND date = ?");
    $stmt->execute([$object_id, $d]);

    if ($stmt->fetchColumn() == 0) {
        $dates[] = $d;
    }
}

echo json_encode($dates);
