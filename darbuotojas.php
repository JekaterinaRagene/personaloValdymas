<?php
include "funkcijos.php";
head('Darbuotojo informacija');  

$servername = "localhost";
$username = "root";
$password = "";
$database = 'projektas1';

// Create connection
$connection = mysqli_connect($servername, $username, $password, $database);
//mysqli_ser_charset($connection, 'UTF8');
mysqli_set_charset($connection, "utf8");
// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM darbuotojai";
$result = mysqli_query($connection, $query);

$darbuotojai = [];
if (mysqli_num_rows($result) > 0) {
    while ($darbuotojas = mysqli_fetch_assoc($result)){
        $darbuotojai[] = $darbuotojas;
//        echo '<pre>';
//        print_r($darbuotojas) . '<br>';
//        echo '</pre>';
    }
    // print_r(mysqli_fetch_assoc($result);
    //print_r(mysqli_fetch_row($result));
//print_r(mysqli_fetch_array($result));
}  
if(count($darbuotojai) == 0) {
    echo 'Tokiu darbuotoju nera';
} else {
    echo '<ol>';
    foreach ($darbuotojai as $darbuotojas) {
        echo '<div>' . $darbuotojas['name'] . ' ' . $darbuotojas ['surname'] . '</div>';
              
        }
}
?>
<div class="col-md-12">
    <h1><?php $darbuotojas['name'] . ' ' . $darbuotojas['surname'] ;?></h1>
        
    
</div>
<div class="col-md-6">
    <p>
        <b>Pareigos: </b> <br /> Direktorius
    </p>
    <p>
        <b>Mėnesinė alga: </b> <br />500 EUR
    </p>

</div>
<div class="col-md-6">
    <p>
        <b>Telefonas: </b> <br /> +370 670 21276
    </p>
</div>

<div class="col-md-6">
    <h2>Mokesčiai</h2>

    <table class="table table-hover">
        <tr>
            <td>Priskaičiuotas atlyginimas „ant popieriaus“:</td>
            <td class="curr">500.00 EUR</td>
        </tr>
        <tr>
            <td>Pritaikytas NPD</td>
            <td class="curr">149.00 EUR</td>
        </tr>
        <tr>
            <td>Pajamų mokestis 15 %</td>
            <td class="curr">52.65 EUR</td>
        </tr>
        <tr>
            <td>Sodra. Sveikatos draudimas 6 %</td>
            <td class="curr">30 EUR</td>
        </tr>
        <tr>
            <td>Sodra. Pensijų ir soc. draudimas 3 %</td>
            <td class="curr">15 EUR</td>
        </tr>

        <tr class="info">
            <td>Išmokamas atlyginimas „į rankas“:</td>
            <td class="curr"><b>402.35 EUR</b></td>
        </tr>

        <tr>
            <td colspan="2"><b>Darbo vietos kaina</b></td>
        </tr>

        <tr>
            <td>Sodra 30.98 %:</td>
            <td class="curr">154.90 EUR</td>
        </tr>

        <tr>
            <td>Įmokos į garantinį fondą 0.2 % :</td>
            <td class="curr">1.00 EUR</td>
        </tr>
        <tr class="info">
            <td>Visa darbo vietos kaina :</td>
            <td class="curr"><b>655.90 EUR</b></td>
        </tr>
    </table>
</div>


<?php footer(); ?>


