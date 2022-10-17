<?php



abstract class Cardetail{

    protected $isBroken;
    protected $type;

    public function __construct($type,$isBroken)
    {
        $this->isBroken = $isBroken;
        $this->type = $type;
    }

    public function isBroken()
    {
        echo $this->isBroken ? $this->type." Broken <br>" : $this->type." is not broken <br>";
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

$car = new Car([new Door("Door",false),new Tyre("Tyre",false),new Paint("Paint",true)]);

$car->getCarDetails();
