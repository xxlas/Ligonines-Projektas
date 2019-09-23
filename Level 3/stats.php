<?php
require_once('Database.php');
require_once('Registration.php');
require_once('Specialist.php');

$conn = Database::getConnection();
$reg = new Registration($conn);
$spec = new Specialist($conn);
$specList = $spec->getSpecialistList();

$weekAgo = new DateTime('7 days ago');
$interval = new DateInterval('P1D');
$period = new DatePeriod($weekAgo, $interval, 7);
?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<div class="container-fluid">
    <div class="row pt-5">
        <div class="col-md-12"> <h5> Pasirinkite specialistus kuriuos norite matyti </h5> </div>
            <?php
                foreach($specList as $specialist){
                    echo '
                        <div class="col-md-2">
                            <input type="checkbox" name="spec-list" value="'.$specialist['id'].'" checked> '.$specialist['name'].' 
                        </div>
                    ';
                }
            ?>
    </div>
    <div class="row justify-content-center pt-5">
        <button type="button" class="btn btn-sm btn-dark" id="filter-btn"> Filtruoti </button>
    </div>
    <div class="row pt-5">
        <table class="table table-sm table-bordered">
            <thead>
            <tr>
                <th> Daktaras</th>
                <?php
                foreach ($period as $date) {
                    echo '<th>' . $date->format('Y-m-d') . '</th>';
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($specList as $specialist) {
                echo '<tr id="'.$specialist['id'].'">
                        <td class="align-middle"> ' . $specialist['name'] . '</td>
                    ';
                foreach ($period as $date) {
                    $times = $reg->getAverageTimeAndCountBySpecialistPerDay($specialist['id'], $date->format('Y-m-d'));
                    $hoursAndMinutes = $reg->timestampToHoursAndMinutes($times['average']);
                    echo '
                        <td style="font-size:12px">
                            Per dieną: ' . $times['count'] . ' <br> 
                            Vidutinė trukmė: ' . $hoursAndMinutes['hours'] . ' val. ' . $hoursAndMinutes['minutes'] . ' min.
                        </td>';
                }
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $("#filter-btn").click(function(){
        $('input[name="spec-list"]').each(function(key, val){
            if(this.checked){
                $("#"+$(this).val()).show();
            } else {
                $("#"+$(this).val()).hide();
            }
        })
    })
</script>
