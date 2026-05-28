<?php
class Person
{
    public $name;
    public $age;
    public $address;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getInfo()
    {
        return "Name: " . $this->name . "<br>" .
            "Age: " . $this->age . "<br>" .
            "Address: " . $this->address . "<br>";
    }

    public function canVote()
    {
        if ($this->age >= 18) {
            return true;
        } else {
            return false;
        }
    }
}


$person = new Person();
$person->setName("gialuann");
$person->setAge(25);
$person->setAddress("123 Main Street, City");

echo $person->getInfo() . "<br>";

if ($person->canVote()) {
    echo "This person can vote.";
} else {
    echo "This person cannot vote.";
}
