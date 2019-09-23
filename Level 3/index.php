<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php
require_once('Database.php');
require_once('Registration.php');
require_once('Client.php');
require_once('Specialist.php');
require_once('CompletionTime.php');

$conn = Database::getConnection();
$reg = new Registration($conn);
$clients = $reg->getRegistrations();
$clientObj = new Client($conn);
$spec = new Specialist($conn);
$comp = new CompletionTime($conn);
?>
<div class="container">
    <?php if(!empty(htmlspecialchars($_GET['canceled']))) {?>
        <div class="row justify-content-center">
            <div class="alert alert-success">
                Jūsų vizitas buvo nutrauktas
            </div>
        </div>
    <?php } ?>
    <div class="row justify-content-center pt-5">
        <h3> Sveiki prisijungę prie sistemos </h3>
    </div>
    <div class="row justify-content-center pt-5">
        <a href="register.php" class="btn btn-lg btn-dark"> Registruotis </a>
    </div>
    <div class="row pt-5">
        <table class="table">
            <thead>
            <tr>
                <th> Nr. eilėje</th>
                <th> Kliento Nr.</th>
                <th> Klientas</th>
                <th> Specialistas</th>
                <th> Registracijos laikas</th>
                <th> Vidutiniškai laukti liko:</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($clients as $key => $client) {
                $specId = $client['specialist_id'];
                $clientId = $client['client_id'];
                $time = $reg->getAverageWaitingTimeByClient($clientId, $specId);
                echo '
                        <tr>   
                            <td> ' . ($key + 1) . '</td>
                            <td> ' . $client['id'] . ' </td>
                            <td> ' . htmlspecialchars($clientObj->getName($clientId)) . '</td>
                            <td> ' . $spec->getName($specId) . ' </td>
                            <td> ' . $client['registered_at'] . ' </td>
                            <td> ' . $time['hours'] . ' val. ' . $time['minutes'] . ' min.<br></td>
                        </tr>    
                    ';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
