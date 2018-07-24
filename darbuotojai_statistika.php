<?php
require 'funkcijos.php';
head('Darbuotoju statistika'); 
menu();
$servername = "localhost";
$username = "root";
$password = "";
$database = "pvs";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $database);
//mysqli_ser_charset($connection, 'UTF8');
mysqli_set_charset($connection, "utf8");
// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} 
?>

<div class="col-md-12">
    <h2>Įmonėje dirbančių darbuotojų statistika pagal išsilavinimą</h2>
        <table class="table">
            <tr>
                <th>Išsilavinimas</th>
                <th>Kiekis</th>
                <th>Vidutinis užmokestis</th>
            </tr>
            <?php 
                
                $query = "SELECT COUNT(education) AS issilavinimoVnt, education, AVG(salary) AS vidutineAlga FROM darbuotojai GROUP BY education";
                $result = mysqli_query($connection, $query);
                $statistika = [];  
                if (mysqli_num_rows($result) > 0) {
                    while ($issilavinimas = mysqli_fetch_assoc($result)) {
                        $statistika[] = $issilavinimas;
//                        echo '<pre>';
//                        print_r($issilavinimas);
//                        echo '</pre>';
                    }
                if (mysqli_num_rows($result) == 0) {
                    echo 'Pasirinkote neegzistuojancius duomenys';
                }
                }                
               foreach ($statistika as $issilavinimas) { ?>
            <tr>
                <td><?php echo $issilavinimas['education'] ;?></td>
                <td><?php echo $issilavinimas['issilavinimoVnt'] ;?></td>
                <td><?php echo round(($issilavinimas['vidutineAlga']) /100, 2) ;?> EUR</td>
            </tr>
               <?php } ?>            
        </table>
    </div>    
                
<div class="col-md-12">
    <h2>Darbuotojų statistika pagal lytį</h2>
    <table class="table">
        <tr>
            <th>Lytis</th>
            <th>Kiekis</th>
            <th>Procentai</th>
        </tr>
        <?php                 
                $query = "SELECT COUNT(gender) AS lytis,  gender FROM darbuotojai GROUP BY gender";
                $result = mysqli_query($connection, $query);
                $lytis = [];
                $isVisoDarbuotoju = 0;
                
                if (mysqli_num_rows($result) == 0) {
                    echo 'Pasirinkote neegzistuojancius duomenys';
                }
                
                if (mysqli_num_rows($result) > 0) {
                    while ($lytiesStatistika = mysqli_fetch_assoc($result)) {
                        $lytis[] = $lytiesStatistika;
                        $isVisoDarbuotoju += $lytiesStatistika['lytis'];
                    }
                }                
               foreach ($lytis as $lytiesStatistika) { ?>
        <tr>
            <td><?php echo $lytiesStatistika['gender'];?></td>
            <td><?php echo $lytiesStatistika['lytis'];?></td>
            <td><?php echo round($lytiesStatistika['lytis'] * 100 / $isVisoDarbuotoju, 2); ?> %</td>
        </tr>
               <?php } ?>
        </table>
</div>
