<?php
require "config.php";
include "funkcijos.php";
head('Darbuotojai pagal pareigas'); 

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$connection = mysqli_connect($servername, $username, $password, DATABASE);
//mysqli_ser_charset($connection, 'UTF8');
mysqli_set_charset($connection, "utf8");
// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $pareiguId = $_GET['id'];
} else {
    echo "Nenurodytas pareigu ID";
    exit;
}

$query = "SELECT * FROM pareigos WHERE id = " . $pareiguId;
$row = mysqli_query($connection, $query);
$pareigos = mysqli_fetch_assoc($row);

$query = "SELECT * FROM darbuotojai WHERE pareigos_id = " . $pareiguId;
$result = mysqli_query($connection, $query);

$darbuotojai = [];
if (mysqli_num_rows($result) > 0) {
    while ($darbuotojas = mysqli_fetch_assoc($result)){
        $darbuotojai[] = $darbuotojas;
    }
}

?>

<div class="col-md-12">
    <h1>Darbuotojai pagal pareigas: <b><?php echo $pareigos['name']; ?></b></h1>
</div>

<div class="col-md-12">
    <h2>Darbuotojų sąrašas</h2>
    
    <?php if (count($darbuotojai) == 0) { ?>
    <p>
        Tokiu darbuotoju nera.
    </p>
    <?php } else { ?>
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
        
        <?php foreach ($darbuotojai as $darbuotojas) { ?>
        <tr>
            <td><strong><?php echo $darbuotojas['id'];?></strong></td>
            <td><?php echo $darbuotojas['name'];?></td>
            <td><?php echo $darbuotojas['surname'];?></td>
            <td><?php echo $darbuotojas['phone'];?></td>
            <td><?php echo $darbuotojas['education'];?></td>
            <td><?php echo round($darbuotojas['salary'] / 100, 2); ?></td>
            <td><a href="darbuotojas.php?id=<?php echo $darbuotojas['id'];?>" class="btn btn-primary">Plačiau</a></td>
        </tr>
        <?php } ?>        
    </table>
    <?php } ?>
</div>

<?php 
footer(); 
mysqli_close($connection);
?>
