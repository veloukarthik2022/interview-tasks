<?php



abstract class Cardetail{

    protected $isBroken;

    public function __construct($isBroken)
    {
        $this->isBroken = $isBroken;
    }

    public function isBroken()
    {
        echo $this->isBroken ? "Broken <br>" : "Is not broken <br>";
    }
}

class Door extends Cardetail{

}

class Tyre extends Cardetail{

}

class Paint extends Cardetail{

}

class Car{

    protected $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function getCarDetails()
    {
        foreach($this->details as $details)
        {
            $details->isBroken();
        }
        
    }
}

$car = new Car([new Door(true),new Tyre(false),new Paint(true)]);

$car->getCarDetails();
