<?php
require_once ('Database.php');
require_once ('Registration.php');

$conn = Database::getConnection();
$reg = new Registration($conn);

$regId = $_POST['id'];
$url = $_POST['referer'];
$reg->updateCompletionStatus($regId, 2); // nutraukta

header("Location: index.php?canceled=1");

