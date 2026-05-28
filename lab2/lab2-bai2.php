<?php
class Product
{
    public $name;
    public $price;
    public $quantity;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getInfo()
    {
        return "Name: " . $this->name . "<br>" .
            "Price: " . $this->price . "<br>" .
            "Quantity: " . $this->quantity . "<br>";
    }

    public function calculateTotal()
    {
        return $this->price * $this->quantity;
    }
}

$product = new Product();
$product->setName("Iphone 14 Pro Max");
$product->setPrice("10000");
$product->setQuantity("100");

echo $product->getInfo() . "<br>";
echo "Total: $" . $product->calculateTotal();
