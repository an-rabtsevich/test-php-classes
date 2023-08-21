<?php

require_once 'DBConnection.php';
require_once 'People.php';
require_once 'PeopleList.php';

try {

    $db = new DBConnection();

    $newPerson1 = new People(1);
    $newPerson2 = new People(8);
    $newPerson3 = new People("Harry", "Potter", "1980-01-12", 1, "Godric's Hollow");
    $newPerson4 = new People("Dana", "Scully", "1984-11-13", 0, "Maryland");
    $arrOfInstances = [$newPerson1, $newPerson2, $newPerson3, $newPerson4];

    echo '<pre>';
    var_dump($newPerson1->formattingAgeAndOrSex(true, true));
    echo '</pre>';

    echo People::dateToAge('2001-10-21');
    echo '<br>';
    echo People::sexBinaryToText(1);

    echo '<pre>';
    var_dump($arrOfInstances);
    echo '</pre>';

    $newList = new PeopleList("Triss", "Merigold", "1994-11-13", 0, "Maribor");
    echo '<pre>';
    var_dump($newList);
    echo '</pre>';

    echo '<pre>';
    var_dump($newList->getInstancesById($arrOfInstances));
    echo '</pre>';

    //$newList->deleteInstancesFromDbById($arrOfInstances)

} catch (\Throwable $th) {
    echo 'Caught exception: ',  $th->getMessage(), "\n";
}


?>