<?php

class PeopleList
{
    private $peopleIdArray = [];

    public function __construct($firstName, $lastName, $dateOfBirth, $sex, $cityOfBirth, $sign = '>')
    {

        if (!class_exists(People::class)) 
        {
            throw new Exception("Class People doesn't exist");
        }

        global $db;
        $personQuery = "SELECT `person_id` FROM `people_info` WHERE `first_name` = '$firstName' AND `last_name` = '$lastName' AND `date_of_birth` = '$dateOfBirth' AND `sex` = '$sex' AND `city_of_birth` = '$cityOfBirth'";
        $resultId = mysqli_fetch_row($db->connection->query($personQuery));
        if(!$resultId[0])
        {
            throw new Exception("There is no such person!");
        }

        if($sign === '>')
        {
            $personIdQuery = "SELECT `person_id` FROM `people_info` WHERE `person_id` > '$resultId[0]'";
        }
        else if($sign === '<')
        {
            $personIdQuery = "SELECT `person_id` FROM `people_info` WHERE `person_id` < '$resultId[0]'";
        }
        else if($sign === '!=')
        {
            $personIdQuery = "SELECT `person_id` FROM `people_info` WHERE `person_id` != '$resultId[0]'";
        }

        $result = mysqli_fetch_all($db->connection->query($personIdQuery), MYSQLI_NUM);
        foreach ($result as $value) {
            $this->peopleIdArray[] = $value[0];
        }
    }

    public function getInstancesById($arrOfInstances)
    {
        $resultArrayOfInstances = [];
        foreach ($arrOfInstances as $valuePerson) 
        {
            foreach($this->peopleIdArray as $valueId)
            {
                if($valuePerson->getPersonId() == $valueId)
                {
                    $resultArrayOfInstances[] = $valuePerson;
                }
            }
        }

        return $resultArrayOfInstances;
    }

    public function deleteInstancesFromDbById($arrOfInstances)
    {
        global $db;
        $arrayOfInstances = $this->getInstancesById($arrOfInstances);
        foreach ($arrayOfInstances as $value) 
        {
            $delId = $value->getPersonId();
            $delPersonQuery = "DELETE FROM `people_info` WHERE `person_id` = '$delId'";
            $db->connection->query($delPersonQuery);
        }
    }

}

?>