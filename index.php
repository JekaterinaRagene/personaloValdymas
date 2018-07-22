 <?php
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
    $query = "SELECT * FROM pareigos WHERE id = " . $darbuotojas['pareigu_id'];
    $result = mysqli_query($connection, $query);
    $pareiguPavadinimas = mysqli_fetch_assoc($result);    
    //print_r($pareiguPavadinimas);       
    }
    // print_r(mysqli_fetch_assoc($result);
    //print_r(mysqli_fetch_row($result));
//print_r(mysqli_fetch_array($result));
} 

$query = "SELECT * FROM pareigos";
$result = mysqli_query($connection, $query);
$pareigos = [];
if (mysqli_num_rows($result) > 0) {
    while ($pareiga = mysqli_fetch_assoc($result)) {
        $pareigos[] = $pareiga;
//    echo '<pre>';
//    print_r($pareiga);
//    echo '</pre>';
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
        echo '<li><a href="darbuotojas.php?id=,  "> Darbuotojas:</a> ' . $darbuotojas['name'] . ' ' . $darbuotojas['surname'] . ',' 
                .'<a href="pareigos.php?id=,  "> pareigos</a> ' . ' - '. $pareiguPavadinimas['name'] . ', '
                . ' gaunantis bazine alaga:' . $baseSalary['base_salary'] . ' Eur' .  ', </li>';
        }
        echo '</ol>';
}

mysqli_close($connection);
?>

