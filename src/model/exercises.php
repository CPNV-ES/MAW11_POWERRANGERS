<?php

require_once "src/model/bddConnector.php";

function getAllExercises() {
    $bd = dbConnector();

    $querry = "SELECT name FROM exercises";
    $result = $bd->query($querry);

    return $result;

}