<?php
require_once('Database.php');
require_once('Registration.php');
require_once('Specialist.php');
require_once('CompletionTime.php');
$url = htmlspecialchars($_GET['url']);
$conn = Database::getConnection();
$reg = new Registration($conn);
$registration = $reg->getRegistrationByUrl($url);

if (!empty($url) && $registration) {
    $time = $reg->getAverageWaitingTime($registration['client_id'], $registration['specialist_id']);
} else {
    header('Location: 404.php');
}
?>
<head>
    <meta http-equiv="refresh" content="5">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<div class="container">
    <div class="row justify-content-center pt-5">
        <div class="alert alert-success">
            Užregistruota sėkmingai
        </div>
    </div>
    <div class="row justify-content-center pt-5">
        <h1> Jums laukti liko vidutiniškai: <?php echo $time['hours'] . ' val. ' . $time['minutes'] . ' min.' ?> </h1>
    </div>
    <div class="row justify-content-center pt-5">
        <p> Išsisaugokite šitą nuorodą norint peržiūrėti savo laukimą ateityje:
            https://netikraligonine.lt/view?url=<?php echo $url ?></p>
    </div>
    <div class="row justify-content-center pt-5">
        <a href="index.php" class="btn btn-lg btn-dark"> Grįžti į pagrindinį </a>
    </div>
</div>
