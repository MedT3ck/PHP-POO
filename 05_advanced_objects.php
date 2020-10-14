<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
          <meta name="description" content="MOOC POO - PHP OpenClassrooms">
        <meta name="keywords" content="POO, PHP, Bootstrap">
        <meta name="author" content="Ramouz">
            
        <title>PHP POO</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Section Contenu
        ================================================== -->
        <div class="container">
            <section class="row">
                <h1 class="text-center">POO - PHP Examples</h1>
                <h2>Example 1 - Clone</h2>
                <p class="col-sm-12">
                    <?php
                    // Example 1
                    class My_Class
                    {
                        public $_attribut1;
                        public $_attribut2;
                        private static $_countInstances;
                        
                        public function __construct()
                        {
                            self::$_countInstances;
                        }
                        
                        public function __clone()
                        {
                            self::$_countInstances++;
                        }
                        
                        public static function getCountInstances()
                        {
                            return self::$_countInstances;
                        }
                    }
                    
                     // I instantiate the MyClass class
                     // I store the id of the new object and not the object itself
                    $obj01 = new My_Class;
                    $obj3 = clone $obj01;

                    $obj02 = $obj01;

                    $obj01->_attribut1 = 'Hi my friend<br>';
                    echo $obj02->_attribut1; // Return 'Hi my friend'

                    $obj02->_attribut2 = 'Bonjour mon pote<br>';
                    echo $obj01->_attribut2; // Return 'Halo Freund'
                    
                      // I copy the object and I create a new object
                     // A new identifier is created - each object has its own identifier
                     // Each object can handle new attributes without affecting the old attributes

                    $copieObject = clone $obj01;
                    $obj01->_attribut1 = 'New phrase<br>';
                    echo $copieObject->_attribut1;  // Return Hi my friend and  New Phrase
                    echo $obj01->_attribut1;        // Retrun 'New phrase'
                    
                    echo 'Nombre d\'instances de MyClass : ' . My_Class::getCountInstances() . '<br>';
                    ?>
                </p>
                
                
                <h2>Example 2 - Object comparison</h2>
                <p class="col-sm-12">
                    <?php
                    // Example 1
                    class My_Class_2
                    {
                        public $_attribut1;
                        public $_attribut2;
                    }
                    
                    class My_Class_3
                    {
                        public $_attribut1;
                        public $_attribut2;
                    }
                    
                    $obj4 = new My_Class_2;
                    $obj4->_attribut1 = 'Hi';
                    $obj4->_attribut2 = 'Salut';
                    
                    $obj5 = new My_Class_3;
                    $obj5->_attribut1 = 'Hi';
                    $obj5->_attribut2 = 'Salut';
                    
                    $obj6 = new My_Class_2;
                    $obj6->_attribut1 = 'Hi';
                    $obj6->_attribut2 = 'Salut';
                    
                    if ($obj4 == $obj5) {
                        echo '$obj4 == $obj5';
                    } else {
                        echo '$obj4 != $obj5';
                    }
                    
                    echo '<br>';
                    
                    if ($obj4 == $obj6) {
                        echo '$obj4 == $obj6';
                    } else {
                        echo '$obj4 != $obj6';
                    }
                    ?>
                </p>
                
                
                <h2>Example 3 - strictly identical operator (===)</h2>
                <p class="col-sm-12">
                    <?php
                    // Example 1
                    class My_Class_4
                    {
                        public $_attribut1;
                        public $_attribut2;
                    }
                    
                    $obj7 = new My_Class_4;
                    $obj7->_attribut1 = 'Hi';
                    $obj7->_attribut2 = 'Salut';
                    
                    $obj8 = new My_Class_4;
                    $obj8->_attribut1 = 'Hi';
                    $obj8->_attribut2 = 'Salut';
                    
                    $obj9 = $obj7;
                    
                    if ($obj7 === $obj8) {
                        echo '$obj7 === $obj8';
                    } else {
                        echo '$obj7 != $obj8';
                    }
                    
                    echo '<br>';
                    
                    if ($obj7 === $obj9) {
                        echo '$obj7 === $obj9';
                    } else {
                        echo '$obj4 != $obj6';
                    }
                    ?>
                    
                    
                <h2>Example 3 - object course</h2>
                <p class="col-sm-12">
                    <?php
                    // Example 1
                    class My_Class_5
                    {
                        public $_attributPublic1 = 'Attribut public 1';
                        public $_attributPublic2 = 'Attribut public 2';
                        
                        protected $attributProtected1 = 'Attribut protégé 1';
                        protected $atrributProtected2 = 'Attribut protégé 2';
                        
                        private $_attributPrivate1 = 'Attribut privé 1';
                        private $_attributPrivate2 = 'Attribut privé 2';
                        
                        function parcoursAttributs()
                        {
                            foreach ($this as $attribut => $valeur) {
                                echo '<strong>' . $attribut . '</strong> => ' . $valeur . '<br>';
                            }
                        }
                    }
                    
                    class My_Class_6 extends My_Class_5
                    {
                        // I declare the function to not call the parent function
                        function parcoursAttributs()
                        {
                            foreach ($this as $attribut => $valeur) {
                                echo '<strong>' . $attribut . '</strong> => ' . $valeur . '<br>';
                            }
                        }
                    }
                    
                    $objMother  = new My_Class_5;
                    $objChild   = new My_Class_6;
                    
                    echo '<strong>List of attributes from the parent class</strong><br>';
                    $objMother->parcoursAttributs();
                    
                    echo '<br>';
                    
                    echo '<strong>List of attributes from the child class</strong><br>';
                    $objChild->parcoursAttributs();
                    
                    echo '<br>';
                    
                    echo '<strong>List of attributes from the main script</strong><br>';
                    foreach ($objMother as $attribut => $valeur) {
                        echo '<strong>' . $attribut . '</strong> => ' . $valeur . '<br>';
                    }
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>