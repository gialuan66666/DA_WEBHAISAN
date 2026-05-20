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
        return "Tên: " . $this->name . ", Tuổi: " . $this->age . ", Địa chỉ: " . $this->address;
    }
    public function canVote()
    {
        if ($this->age >= 18) {
            return "true";
        } else {
            return "false";
        }
    }
    // sử dung lớp Person

}
$person = new Person(); 
$person->setName("Nguyễn Văn A");
$person->setAge(25);
$person->setAddress("Hà Nội");

// Hiển thị thông tin
echo $person->getInfo(); // Output: Tên: Nguyễn Văn A, Tuổi
if($person->canVote()){
    echo "Có thể bỏ phiếu";
} else {
    echo "Không thể bỏ phiếu";
}