 <?php
 require 'config.php';
 
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

$query = "SELECT * FROM darbuotojai";
$result = mysqli_query($connection, $query);

$darbuotojai = [];
if (mysqli_num_rows($result) > 0) {
    while ($darbuotojas = mysqli_fetch_assoc($result)) {        
        $query = "SELECT * FROM pareigos WHERE id = " . $darbuotojas['pareigos_id'];
        $row = mysqli_query($connection, $query);
        $pareigos = mysqli_fetch_assoc($row);
        
        if (mysqli_num_rows($row) == 0) {
            $pareigos = [];
        }        
        $darbuotojas['pareigos'] = $pareigos;
        
        $darbuotojai[] = $darbuotojas;
    }
}

mysqli_close($connection);

if(count($darbuotojai) == 0) {
    echo 'Tokiu darbuotoju nera';
} else {
    echo '<ol>';
    foreach ($darbuotojai as $darbuotojas) {
        ?>
        <li>
            Darbuotojas:
            <a href="darbuotojas.php?id=<?php echo $darbuotojas['id']; ?>">
                <?php echo $darbuotojas['name'] . ' ' . $darbuotojas['surname']; ?>
            </a>
            <?php if (!empty($darbuotojas['pareigos'])) { ?>
                pareigos -
                <a href="pareigos.php?id=<?php echo $darbuotojas['pareigos']['id']; ?>">
                    <?php echo $darbuotojas['pareigos']['name']; ?>
                </a>                
                gaunantis bazine alga: <?php echo $darbuotojas['pareigos']['base_salary']; ?> Eur
            <?php } ?>
        </li>
        <?php
    }
    echo '</ol>';
}