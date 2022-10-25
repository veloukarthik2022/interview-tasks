<h1>Sample Code</h1>
<pre>
<?php
abstract class Cardetail
{

    protected $isBroken;
    protected $type;

    public function __construct($type, $isBroken)
    {
        $this->isBroken = $isBroken;
        $this->type = $type;
    }

    public function isBroken()
    {
        switch ($this->type) {
            case "Door":
                echo $this->isBroken ? $this->type . " is broken <br>" : $this->type . " is not broken <br>";
                break;
            case "Tyre":
                echo $this->isBroken ? $this->type . " is puncher <br>" : $this->type . " is not puncher <br>";
                break;
            case "Paint":
                echo $this->isBroken ? $this->type." is scratched <br>" : $this->type." is not scratched <br>";
                break;
            default:
                break;
        }
    }
}

class Door extends Cardetail
{
}

class Tyre extends Cardetail
{
}

class Paint extends Cardetail
{
}

class Car
{

    protected $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function getCarDetails()
    {
        foreach ($this->details as $details) {
            if($details->isBroken())
            {
                return true;
            }
        }
    }
}

$car = new Car([new Door("Door", true), new Tyre("Tyre", false), new Paint("Paint", false)]);

$car->getCarDetails();

</pre>
<h1>Output</h1>
<img src="https://github.com/veloukarthik2022/interview-tasks/blob/main/Task%202/result.png">