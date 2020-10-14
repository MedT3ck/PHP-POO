<?php
class MyClass {
    private $_onePrivateAttribut;

    public function __construct() {
        echo 'Construction of myClass<br>';
    }
    
    public function __set($nom, $valeur) {
        echo 'Attribute assignment attempt <strong>' . $nom . '</strong> value <strong>' . $valeur . '</strong> - impossible attempt !<br>';
    }
    
    public function __get($name) {
        return 'Can not access attribute <strong>' . $name . '</strong><br>';
    }
    
    public function __destruct() {
        echo 'Destruction of myClass<br>';
    }
}

$obj = new MyClass;

$obj->attribut = 'Simple test';
$obj->onePrivateAttribut = '2nd simple test';

echo $obj->attribut;
echo $obj->onePrivateAttribut;




class MyClass2
{
  private $attributs = [];
  private $onePrivateAttribut;
  
  public function __get($nom)
  {
    if (isset($this->attributs[$nom]))
    {
      return $this->attributs[$nom];
    }
  }
  
  public function __set($nom, $valeur)
  {
    $this->attributs[$nom] = $valeur;
  }
  
  public function showAttributs()
  {
    echo '<pre>', print_r($this->attributs, true), '</pre>';
  }
  
  public function __isset($nom)
  {
    return isset($this->attributs[$nom]);
  }
  
  public function __destruct() {
        echo 'Destruction of myClass2<br>';
    }
}

$obj2 = new MyClass2;
$obj3 = new MyClass2;

$obj2->attribut = 'Simple test<br>';
$obj3->onePrivateAttribut = 'another simple test<br>';

echo $obj2->attribut;
echo $obj3->oneProvateAttribut;

if (isset($obj2->attribut))
{
  echo 'The attribute <strong>attribute</strong> exists !<br>';
}
else
{
  echo 'Attribute <strong> attribute </ strong> does not exist!<br>';
}

if (isset($obj3->onePrivateAttribut))
{
   
  echo ' Attribute <strong> onePrivateAttribut </ strong> attribute exists !<br>';
}
else
{
  echo ' Attribute <strong> onePrivateAttribut </ strong> attribute doesnt exists !<br>';
}