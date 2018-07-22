<?php

$algaAntPopieriaus = $baseSalary['base_salary'];
$npd = $algaAntPopieriaus * 29.8 / 100;
$pajamuMokestis = $algaAntPopieriaus - $npd * 15 / 100;
$sveikatosDraudimas = $algaAntPopieriaus * 6 / 100;
$pensijuDraudimas = $algaAntPopieriaus * 3 / 100;
$algaIRankas = $algaAntPopieriaus - $pajamuMokestis - $sveikatosDraudimas - $pensijuDraudimas;
//darbo vietos kaina
$sodra = $algaAntPopieriaus * 30.98 / 100;
$garantinisFondas = $algaAntPopieriaus * 0.2 / 100;
$darboVietosKaina = $algaAntPopieriaus + $sodra + $garantinisFondas;
