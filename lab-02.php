<?php
/**
 * Lab 03 - PHP OOP Tasks
 * Full Name: [Hamayoon Ahmadi]
 * Student ID: [R01014419]
 */

// Task 1: Create and Use a Class Constant
// The MAX_BOOKS value is constant because it represents a fixed rule
// that applies to all instances of the Library class and should never change.
class Library {
    const MAX_BOOKS = 3;
}

echo "Task 1 Output: <br>";
echo "Maximum books allowed: " . Library::MAX_BOOKS . "<br>";

// Task 2: Create a Static Property and Static Method
class StudentCounter {
    public static $count = 0;

    public static function addStudent() {
        self::$count++;
    }
}

StudentCounter::addStudent();
StudentCounter::addStudent();
StudentCounter::addStudent();

echo "Task 2 Output:<br>";
echo "Total students: " . StudentCounter::$count . "<br>";

// Task 3: Create an Abstract Class and Abstract Method
abstract class Vehicle {
    abstract public function start();
}

class Car extends Vehicle {
    public function start() {
        echo "Car engine started. <br>";
    }
}

class Bike extends Vehicle {
    public function start() {
        echo "Bike started. <br>";
    }
}

echo "Task 3 Output:\n";
$car = new Car();
$bike = new Bike();
$car->start();
$bike->start();
?>