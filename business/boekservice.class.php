<?php


require_once("data/boekDAO.class.php");

class BoekService
{
    public function getBoekenOverzicht()
    {
        $boekDAO = new BoekDAO();
        $lijst = $boekDAO->getAll();
        return $lijst;
    }
}