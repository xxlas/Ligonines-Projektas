<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php
require_once('Database.php');
require_once('Registration.php');
require_once('Client.php');
require_once('Specialist.php');

$conn = Database::getConnection();
$reg = new Registration($conn);
$clients = $reg->getRegistrations();
$clientObj = new Client($conn);
$spec = new Specialist($conn);
?>
<div class="container">
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
            </tr>
            </thead>
            <tbody>
            <?php foreach ($clients as $key => $client) {
                echo '
                        <tr>   
                            <td> ' . ($key + 1) . '</td>
                            <td> ' . $client['id'] . ' </td>
                            <td> ' . $clientObj->getName($client['client_id']) . '</td>
                            <td> ' . $spec->getName($client['specialist_id']) . ' </td>
                            <td> ' . $client['registered_at'] . ' </td>
                        </tr>    
                    ';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
