<?php
include "funkcijos.php";
head('Darbuotojai pagal pareigas'); 

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
    <h1>Darbuotojai pagal pareigas: <b><?php echo $pareiguPavadinimas['name']; ?></b></h1>
</div>  
<div class="col-md-12">
    <h2>Darbuotojų sąrašas</h2>
    <table class="table">
        <tr>
            <th></th>
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Tel. nr.</th>
            <th>Išsilavinimas</th>
            <th>Alga, Eur</th>
            <th></th>
        </tr>
        <tr>
            <td><strong>1.</strong></td>
            <td><?php echo $darbuotojas['name'];?></td>
            <td><?php echo $darbuotojas['surname'];?></td>
            <td><?php echo $darbuotojas['phone'];?></td>
            <td><?php echo $darbuotojas['education'];?></td>
            <td><?php echo $baseSalary['base_salary'];?></td>
            <td><a href="darbuotojas.php" class="btn btn-primary">Plačiau</a></td>
        </tr>
    </table>
</div>
       
<?php 
    }
}
?>



<div class="col-md-6">
    <h2>Baziniai darbo užmokesčiai:</h2>

    <table class="table">
        <tr>
            <th>Pareigos</th>
            <th>Bazinis darbo užmokestis</th>
            <th></th>
        </tr>
        <tr>
            <td>Direktorius</td>
            <td>1500 EUR</td>
            <td><a href="#" class="btn btn-primary">Rodyti darbuotojus</a></td>
        </tr>
        <tr>
            <td>Programotojas</td>
            <td>1500 EUR</td>
            <td><a href="#" class="btn btn-primary">Rodyti darbuotojus</a></td>
        </tr>
        <tr>
            <td>Valytojas</td>
            <td>1000 EUR</td>
            <td><a href="#" class="btn btn-primary">Rodyti darbuotojus</a></td>
        </tr>
    </table>
</div>

<?php footer(); 
mysqli_close($connection);
?>


