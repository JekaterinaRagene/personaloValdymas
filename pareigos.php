<?php
include "funkcijos.php";

head('Darbuotojai pagal pareigas'); 
?>
<div class="col-md-12">
    <h1>Darbuotojai pagal pareigas: <b>Direktorius</b></h1>
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
            <th>Alga</th>
            <th></th>
        </tr>
        <tr>
            <td><strong>1.</strong></td>
            <td>Vardas</td>
            <td>Pavardauskas</td>
            <td>+370000000</td>
            <td>Aukštasis</td>
            <td>00000</td>
            <td><a href="darbuotojas.php" class="btn btn-primary">Plačiau</a></td>
        </tr>
    </table>
</div>

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

<?php footer(); ?>


