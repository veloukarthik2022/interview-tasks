<?php
class User{

    public $data;

    function setFirstName($name)
    {
        $this->data = $name;
    }
    function setLastName($lname)
    {
        $this->data .= " " . $lname;
    }
    function setEmail($email)
    {
        $email = "< " . $email . " >";
        $this->data .= " " . $email;
        // echo '"'.$this->data.'"';
    }

    public function __toString()
    {
        return '"'.$this->data.'"';
    }
}

$user = new User;
$user->setFirstName("Apple");
$user->setLastName("Newton");
$user->setEmail("apple@newton.com");

echo $user;
    