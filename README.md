# test-php-classes

## Solved Tasks Conditions

### Task 1.

Create a class to work with the people database

The database contains the fields:
id, first name (letters only), last name (letters only), date of birth, sex (0,1), city of birth.

The class must have fields:
id, first name, last name, date of birth, sex(0,1), city of birth.

The class must have methods:
1. Saving the fields of a class instance in the database;
2. Removing a person from the database in accordance with the object id;
3. static conversion of date of birth to age (complete years);
4. static conversion of sex from binary to text system (male, female);
5. The class constructor either creates a person in the database with the given information, or takes information from the database by id (provide for data validation);
6. Formatting a person with transformation of age and (or) gender (step 3 and step 4) depending on the parameters (returns a new instance of stdClass with all the fields of the original class).


### Task 2.

Create a class to work with lists of people

The class works using the class developed in task 1.

The database contains the fields:
id, first name (letters only), last name (letters only), date of birth, sex (0,1), city of birth.

The class must have fields:
An array with people's ids.

The class must have methods:
1. The constructor searches for people’s ids across all fields of the database (supports expressions greater than, less than, not equal to);
2. Obtaining an array of instances of class 1 from the array with the id of people obtained in the constructor;
3. Removing people from the database using instances of class 1 in accordance with the array received in the constructor.

Classes must be located in different files.
Connecting files with classes and the rest of the code is in file 3.
A file with the 2nd class must be checked for the presence of the first class.
If the class is missing, print an error and do not declare class 2.

Don't use frameworks, only pure PHP.

## Built With

<span><img src="https://img.shields.io/badge/PHP-%234f5b93?style=flat-square" alt="PHP"></span>

## Developers

- [an-rabtsevich](https://github.com/an-rabtsevich)
