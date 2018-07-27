<?php
require 'funkcijos.php';
head('Pridėti darbuotoja'); 
menu();
$servername = "localhost";
$username = "root";
$password = "";
$database = "projektas1";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $database);
//mysqli_ser_charset($connection, 'UTF8');
mysqli_set_charset($connection, "utf8");
// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} 
$birthday = 0;
if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['phone']) 
        && isset($_POST['education']) && isset($_POST['salary'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $surname = mysqli_real_escape_string($connection, $_POST['surname']);
    $gender = mysqli_real_escape_string($connection, $_POST['gender']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $education = mysqli_real_escape_string($connection, $_POST['education']);
    $salary = mysqli_real_escape_string($connection, $_POST['salary']);
    $pareigos = mysqli_real_escape_string($connection, $_POST['pareigu_id']);
    
    $query = "INSERT INTO darbuotojai (name, surname, gender, phone, birthday, "
            . "education, salary, pareigu_id)"
            . " VALUES ('$name', '$surname', '$gender', '$phone', '$birthday',"
            . "'$education', '$salary', '$pareigos')";

    $result = mysqli_query($connection, $query);
    
    if (!$result) {
        echo 'KLAIDA';
        die;
    }
} 
?>

<div class="col-md-12">
    <h2>Naujas darbuotojas:</h2>

    <form action="" method="post">
        <div class="col-md-6">
            <div class="form-group">
                <label for="vardas">Vardas</label> 
                <input name="name" type="text" class="form-control" id="vardas" placeholder="Vardas">
            </div>
            <div class="form-group">
                <label for="pavarde">Pavardė</label> 
                <input name="surname" type="text" class="form-control" id="pavarde" placeholder="Pavarde">
            </div>
            <div class="form-group">
                <label for="lytis">Lytis</label> 
                <select name="gender" id="lytis" class="form-control">
                        <option>Vyras</option>
                        <option>Moteris</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tel">Telefonas</label> 
                <input name="phone" type="text" class="form-control" id="tel" placeholder="Telefonas">
            </div>
            <div class="form-group">
                <label for="birthday">Gimtadienis</label> 
                <input name="birthday" type="date" class="form-control" id="birthday">
            </div>            
           <div class="form-group">
                <label for="tel">Išsilavinimas</label> 
                <input name="education" type="text" class="form-control" id="education" placeholder="Išsilavinimas">
            </div>
            <div class="form-group">
                <label for="issilavinimas">Atlyginimas</label>
                <input name="salary" type="text" class="form-control" id="salary" placeholder="Atlyginimas">
            </div>
        </div>
        <div class="col-md-6">        
            <div class="form-group">
                <label for="pareigos">Pareigos</label> 
                <select name="pareigu_id" id="pareigos" class="form-control">
                <?php        
                $query = "SELECT * FROM pareigos";
                $result = mysqli_query($connection, $query);
                $pareigos = [];
                if (mysqli_num_rows($result) > 0) {
                    while ($pareiga = mysqli_fetch_assoc($result)) {
                    $query = "SELECT COUNT(*) FROM darbuotojai WHERE pareigu_id = " . $pareiga['id'];
                    $result2 = mysqli_query($connection, $query);
                    if (mysqli_num_rows($result2) == 0) {
                        $pareiga['darbuotojuSkaicius'] = 0;
                    } else {                    
                        $darbuotojuSkaicius = mysqli_fetch_row($result2);
                        $pareiga['darbuotojuSkaicius'] = $darbuotojuSkaicius[0];
                    }
                    $pareigos[] = $pareiga;
                    ?>
                    <option><?php echo $pareiga['name'] ?></option>
                   <?php 
                    }
                }
                ?> 
                </select>
            </div>                        
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <input type="submit" class="btn btn-primary" value="Pridėti">
        </div>
    </form>
</div>

<?php 
mysqli_close($connection);
footer(); 
?>