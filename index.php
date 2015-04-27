<?php


//require_once("data/boekDAO.class.php");
require_once("business/boekservice.class.php");




$service = new BoekService();
echo '<pre>';
print_r($service->getBoekenOverzicht());
echo '</pre>';
