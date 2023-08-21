<?php

class People 
{
    private $personId;
    private $firstName;
    private $lastName;
    private $dateOfBirth;
    private $sex;
    private $cityOfBirth;

    public function __construct()
    {
        $numOfArgs = func_num_args();

        switch ($numOfArgs) {
            case '1':
                global $db;
                $this->personId = func_get_arg(0);
                $personQuery = "SELECT * FROM `people_info` WHERE `person_id` = '$this->personId'";
                $resultArray = mysqli_fetch_assoc($db->connection->query($personQuery));
                if(!$resultArray)
                {
                    throw new Exception("There is no person with such id: $this->personId");
                }
                $this->firstName = $resultArray['first_name'];
                $this->lastName = $resultArray['last_name'];
                $this->dateOfBirth = $resultArray['date_of_birth'];
                $this->sex = $resultArray['sex'];
                $this->cityOfBirth = $resultArray['city_of_birth'];
                break;
            
            case '5':
                if($this->isValid(func_get_arg(0), func_get_arg(1), func_get_arg(2), func_get_arg(3)))
                {
                    $this->firstName = func_get_arg(0);
                    $this->lastName = func_get_arg(1);
                    $this->dateOfBirth = func_get_arg(2);
                    $this->sex = func_get_arg(3);
                    $this->cityOfBirth = func_get_arg(4);
                    $this->saveIntoDB();
                }
                break;

            default:
                throw new Exception('Invalid number of arguments');
                //break;
        }
    }

    public function isValid($firstName, $lastName, $dateOfBirth, $sex)
    {
        $lettersOnlyReg = "/^[a-zа-я]+$/ui";
        $correctDateReg = "/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/";

        if(!preg_match($lettersOnlyReg, $firstName))
        {
            throw new Exception('First name must contain only letters!');
        }
        if(!preg_match($lettersOnlyReg, $lastName))
        {
            throw new Exception('Last name must contain only letters!');
        }
        if(!preg_match($correctDateReg, $dateOfBirth))
        {
            throw new Exception('Invalid date format!');
        }
        if(!($sex === 0 || $sex === 1))
        {
            throw new Exception('Sex must be 0 or 1!');
        }

        return true;
    }

    public function saveIntoDB()
    {
        global $db;
        $saveIntoQuery = "INSERT INTO `people_info` (`person_id`, `first_name`, `last_name`, `date_of_birth`, `sex`, `city_of_birth`) VALUES (NULL, '$this->firstName', '$this->lastName', '$this->dateOfBirth', '$this->sex', '$this->cityOfBirth')";
        return $db->connection->query($saveIntoQuery);
    }

    public function deleteFromDB($person_id)
    {
        global $db;
        $deleteFromQuery = "DELETE FROM `people_info` WHERE `person_id` = '$person_id'";
        return $db->connection->query($deleteFromQuery);
    }

    public static function dateToAge($dateOfBirth)
    {
        $dateToTime = strtotime($dateOfBirth);
        $age = date('Y') - date('Y', $dateToTime);
        if (date('md') < date('md', $dateToTime)) 
        {
            $age--;
        }
        return $age;
    }

    public static function sexBinaryToText($sex)
    {
        if($sex == 1)
        {
            return "Man";
        }
        else if($sex == 0)
        {
            return "Woman";
        }
        else
        {
            return "Sex must be 0 or 1!";
        }
    }

    public function formattingAgeAndOrSex($isFormattingAge = false, $isFormattingSex = false)
    {
        $formattedPerson = new stdClass();
        $formattedPerson->personId = $this->personId;
        $formattedPerson->firstName = $this->firstName;
        $formattedPerson->lastName = $this->lastName;

        if($isFormattingAge)
        {
            $formattedPerson->dateOfBirth = People::dateToAge($this->dateOfBirth);
        }
        else
        {
            $formattedPerson->dateOfBirth = $this->dateOfBirth;
        }

        if($isFormattingSex)
        {
            $formattedPerson->sex = People::sexBinaryToText($this->sex);
        }
        else
        {
            $formattedPerson->sex = $this->sex;
        }

        $formattedPerson->cityOfBirth = $this->cityOfBirth;
        return $formattedPerson;
    }

    public function getPersonId()
    {
        return $this->personId;
    }
}

?>