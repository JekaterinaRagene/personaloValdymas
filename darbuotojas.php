<?php
require 'funkcijos.php';
head('Darbutojo informacija');
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
        $query = "SELECT * FROM pareigos WHERE id = " . $darbuotojas['pareigu_id'];
        $result = mysqli_query($connection, $query);
        $pareiguPavadinimas = mysqli_fetch_assoc($result);    
        //print_r($pareiguPavadinimas);       
    }
} 

$query = "SELECT * FROM pareigos";
$result = mysqli_query($connection, $query);
$pareigos = [];
if (mysqli_num_rows($result) > 0) {
    while ($pareiga = mysqli_fetch_assoc($result)) {
        $pareigos[] = $pareiga;
        $qury = "SELECT * FROM darbuotojai WHERE pereigu_id =" . $pareiga['base_salary'];
        $result = mysqli_query($connection, $query);
        $baseSalary = mysqli_fetch_assoc($result);
       //print_r($baseSalary);
       break;//jeigu nuimti break tada krauna begalybe 
    }
}

if(count($darbuotojai) == 0) {
    echo 'Tokiu darbuotoju nera';
} else {
    echo '<ol>';
    foreach ($darbuotojai as $darbuotojas) {
     ?>
        <div class="col-md-12">
            <h1><?php echo $darbuotojas['name'] . ' ' . $darbuotojas['surname']; ?></h1>   
        </div>
        <div class="col-md-6">
        <p>
            <b>Pareigos: </b> <br /> <?php echo $pareiguPavadinimas['name']; ?>
        </p>
        <p>
            <b>Mėnesinė alga: </b> <br /><?php echo $baseSalary['base_salary']; ?> EUR
        </p>
    </div>
        <div class="col-md-6">
            <p>
                <b>Telefonas: </b> <br /> <?php echo $darbuotojas['phone'];?>
            </p>
        </div>
        <div class="col-md-6">
            <h2>Mokesčiai</h2>

            <table class="table table-hover">
                <?php 
                $algaAntPopieriaus = $baseSalary['base_salary'];
                $npd = $algaAntPopieriaus * 29.8 / 100;
                $pajamuMokestis = ($algaAntPopieriaus - $npd) * 15 / 100;
                $sveikatosDraudimas = $algaAntPopieriaus * 6 / 100;
                $pensijuDraudimas = $algaAntPopieriaus * 3 / 100;
                $algaIRankas = $algaAntPopieriaus - $pajamuMokestis - $sveikatosDraudimas - $pensijuDraudimas;
                //darbo vietos kaina
                $sodra = $algaAntPopieriaus * 30.98 / 100;
                $garantinisFondas = $algaAntPopieriaus * 0.2 / 100;
                $darboVietosKaina = $algaAntPopieriaus + $sodra + $garantinisFondas;

                ?>
                <tr>
                    <td>Priskaičiuotas atlyginimas „ant popieriaus“:</td>
                    <td class="curr"><?php echo $algaAntPopieriaus ;?></td>
                </tr>
                <tr>
                    <td>Pritaikytas NPD</td>
                    <td class="curr"><?php echo $npd ;?></td>
                </tr>
                <tr>
                    <td>Pajamų mokestis 15 %</td>
                    <td class="curr"><?php echo $pajamuMokestis ;?></td>
                </tr>
                <tr>
                    <td>Sodra. Sveikatos draudimas 6 %</td>
                    <td class="curr"><?php echo $sveikatosDraudimas ;?></td>
                </tr>
                <tr>
                    <td>Sodra. Pensijų ir soc. draudimas 3 %</td>
                    <td class="curr"><?php echo $pensijuDraudimas ;?></td>
                </tr>

                <tr class="info">
                    <td>Išmokamas atlyginimas „į rankas“:</td>
                    <td class="curr"><b><?php echo $algaIRankas ;?></b></td>
                </tr>

                <tr>
                    <td colspan="2"><b>Darbo vietos kaina</b></td>
                </tr>

                <tr>
                    <td>Sodra 30.98 %:</td>
                    <td class="curr"><?php echo $sodra ;?></td>
                </tr>

                <tr>
                    <td>Įmokos į garantinį fondą 0.2 % :</td>
                    <td class="curr"><?php echo $garantinisFondas ;?></td>
                </tr>
                <tr class="info">
                    <td>Visa darbo vietos kaina :</td>
                    <td class="curr"><b><?php echo $darboVietosKaina ;?></b></td>
                </tr>
            </table>
        </div>
<?php
}
}
?>
  






<?php footer(); ?>