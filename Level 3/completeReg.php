<?php

session_start();
require_once('Database.php');
require_once('Registration.php');
require_once('CompletionTime.php');
$conn = Database::getConnection();
$reg = new Registration($conn);
$regId = $_POST['registrationId'];
$specId = $_SESSION['specialistId'];

if (isset($specId) && isset($regId) && $reg->doesRegBelongToSpecialist($specId, $regId)) {
    $completion = new CompletionTime($conn);
    $reg->updateCompletionStatus($regId, 1);
    $completedAt = $reg->getRegistrationTimestamp($regId);
    $diff = $reg->getTimestampDifference($completedAt);
    $completion->addTime($regId, $diff);
}
header("Location: checkout.php?user=$specId");

