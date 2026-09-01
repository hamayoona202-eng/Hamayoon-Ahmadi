<?php

// Part A - Simple Class and Object
// Part A --> sayHello() method.

class Person
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function introduce()
    {
        echo "My name is " . $this->name . "<br><br><br>";
    }
}

class Student extends Person
{
    public $studentId;
    public $department;

    // Constructor with default values to allow no-argument instantiation (Part A)
    public function __construct($name = '', $studentId = '', $department = '')
    {
        parent::__construct($name); // call Person's constructor
        $this->studentId = $studentId;
        $this->department = $department;
    }

    // Part A method
    public function sayHello()
    {
        echo "Hello! I am a student. <br><br><br>";
    }

    // Part B method
    public function showInfo()
    {
        echo "Name: " . $this->name .  "<br>" . "Student ID: " . $this->studentId . "<br>" . "Department: " . $this->department . "<br><br><br>";
    }

    // Part E method
    public function study()
    {
        echo $this->name . " is studying.<br><br><br>";
    }
}

// Part A demonstration
echo "--- Part A --- <br>";
echo "--  We are creating a simple class called Person and then an object of that class --<br>";
$person1 = new Person("Hamayoon"); 
$person1->introduce();

// Part B - Class with Constructor
echo "--- Part B ---<br>";
echo "-- We are creating a class called Person and then another class Student and the Student class is inheriting from the Person class --<br>";
$student1 = new Student("Ahmad", 1001, "Computer Science");
$student1->showInfo();

// Part C - Create Another Object
echo "--- Part C --- <br>";
echo "-- We are creating another object of the Student class --<br> ";
$student2 = new Student("Sara", 1002, "Information Systems");
$student2->showInfo();

// Questions
echo "--- Part C Questions --- <br>";
echo "How many classes did you create?<br>";
echo "Answer: 1 class (Student) – but we also have Person for inheritance.<br>";
echo "How many objects did you create?<br>";
echo "Answer: 2 objects (student1 and student2).<br>";

// Part D - Access Modifiers
echo "<br><br>--- Part D ---<br>";
echo "-- We are creating another class called BankAccount and we are using access modifiers --<br>";
class BankAccount
{
    public $ownerName;
    private $balance;

    public function __construct($ownerName, $balance)
    {
        $this->ownerName = $ownerName;
        $this->balance = $balance;
    }

    public function showBalance()
    {
        echo "Balance: " . $this->balance . "<br>";
    }
}

$account1 = new BankAccount("Ahmad", 5000);
echo "Owner: " . $account1->ownerName . "<br>";
$account1->showBalance();

// Try to access private property directly
echo "<br>--- Part D Try This --- <br>";
echo "-- Answering a Question --<br>";
// echo $account1->balance;
echo "Does it work? -- 'echo \$account1->balance' -- No.<br>";
echo "Why? Because the property 'balance' is declared as private, so it cannot be accessed outside the class.<br><br><br>";



// Part E - Simple Inheritance
echo "--- Part E ---<br>";
echo "-- Reausing the Student class which already extends Person --<br>"; 
// Reuse the Student class which already extends Person.
$student1 = new Student("Ahmad"); // only name given
$student1->introduce(); // from Person
$student1->study();     // from Student

// Part F - Understanding Inheritance (Questions)
echo "--- Part F Questions ---<br>";
echo "Question 1: Which class is the parent class?<br>";
echo "Answer: Person<br>";
echo "Question 2: Which class is the child class?<br>";
echo "Answer: Student<br>";
echo "Question 3: Which keyword creates the inheritance relationship?<br>";
echo "Answer: extends<br>";
echo "Question 4: The introduce() method was written inside which class?<br>";
echo "Answer: Person<br>";
echo "Question 5: Can the \$student1 object call introduce()?<br>";
echo "Answer: Yes, because Student inherits from Person.<br>";
echo "Question 6: Why can \$student1 use introduce() even though it is not written inside the Student class?<br>";
echo "Answer: Because Student extends Person, so it inherits all public and protected methods from the parent class.<br><br><br>";



// Part G - Small Independent Exercise (Vehicle and Car)
echo "--- Part G --- <br>";
echo "-- Another simple example of classes, objects, access modifiers and inheritance. --<br>";
class Vehicle
{
    protected $brand;

    public function __construct($brand)
    {
        $this->brand = $brand;
    }

    public function start()
    {
        echo "The vehicle is starting.<br>";
    }
}

class Car extends Vehicle
{
    public function showBrand()
    {
        echo "Car brand: " . $this->brand . "<br>";
    }
}

$car1 = new Car("Toyota");
$car1->start();
$car1->showBrand();

?>