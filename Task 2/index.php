<?php

abstract class carDetail
{
    protected $isBroken;
    protected $isScratch;
    public function __construct(bool $isBroken,bool $isScratch)
    {
        $this->isBroken = $isBroken;
        $this->isScratch = $isScratch;
    }
    public function isBroken(): bool
    {
        return $this->isBroken;   
    }

    public function isScratch(): bool
    {
        return $this->isScratch;
    }
}

class Door extends carDetail
{
}

class Tyre extends carDetail
{
}

class Car
{

    private  $details;
    public function __construct($details)
    {
        $this->details = $details;
    }

    public function isBroken($type)
    {
        foreach ($this->details as $detail) {
            if ($detail->isBroken() == true) {
                // echo $type." is Broken<br>";
                return true;
            }
           return false;
        }   
      
        
    }

    public function isPaintingDamaged($type)
    {
        // MAKE AN IMPLEMENTATION
        foreach ($this->details as $detail) {
            if ($detail->isScratch() == true) {
                // echo $type." scratch<br>";
                return true;
            }
            return false;
        }
       
       
    }
}
// new Tyre(true),new Door(false)
$car = new Car([new Tyre(true,true),new Door(false,true)]);
echo $car->isBroken("car")."<br>";
echo $car->isPaintingDamaged("paint");
