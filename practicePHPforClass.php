<?php

//おさらい
//classの使い方
//$thisの使い方
//staticの使い方
//selfの使い方

class employee {
    public $name;
    private $state = "I'm working";

    public function getState () {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }
}

$origin = new employee;
$getObj = "I'm taking a nap</br>";
$origin->setState($getObj);
echo $origin->getState();

class useStatic {
    public static $company = "testStatic";
    public function getCompany () {
      return self::$company;
    }

}

$getStatic = new useStatic;
$gotStatic = $getStatic->getCompany();
echo $gotStatic;


?>
