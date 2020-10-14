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
                <h2>Example 1</h2>
                <p>The interface is used to describe the behavior of an object (moving by Example)</p>
                <p class="col-sm-12">
                    <?php
                    // Example 1
                    interface InterfaceName1
                    {
                        const MY_CONSTANT = 'Ma constante de test';
                        public function functionName1($param);
                    }
                    
                    echo 'Constant display test as soon as the interface is created : ' . InterfaceName1::MY_CONSTANT;
                    
                    interface InterfaceName2
                    {
                        public function functionName2($param);
                    }
                        
                    class My_Class implements InterfaceName1, InterfaceName2
                    {
                        public function functionName1($param)
                        {
                            echo 'Toto<br>';
                        }
                        
                        public function functionName2($param)
                        {
                            echo 'Tutu<br>';
                        }
                    }
                    
                    $obj = new My_Class;
                    $obj->functionName1($param);
                    $obj->functionName2($param);
                    
                    echo 'Constant display test after instance creation : ' . $obj::MY_CONSTANT;
                    ?>
                </p>
                
                
                <h2>Example 2 - Heritage</h2>
                <p class="col-sm-12">
                    <?php
                    // Example 2
                    interface InterfaceName3
                    {
                        public function functionName1();
                    }
                    
                    interface InterfaceName3B
                    {
                        public function functionName1B();
                    }
                    
                    // The interface can inherit from several interfaces
                    interface InterfaceName4 extends InterfaceName3, InterfaceName3B
                    {
                        //public function functionName1($param1, $param2); // Generates a fatal error - The inheritance of an interface prohibits rewrite
                        public function functionName1();
                        public function functionName1B();
                    }
                    
                    class My_class2 implements InterfaceName4 {
                        public function functionName1()
                        {
                            echo 'Implements via Extends<br>';
                        }
                        
                        public function functionName1B()
                        {
                            echo 'Multiple inheritance<br>';
                        }
                        
                        public function functionName2()
                        {
                            echo 'Direct perso function in My_Class2<br>';
                        }
                    }
                    
                    $obj02 = new My_class2;
                    $obj02->functionName1();
                    $obj02->functionName1B();
                    $obj02->functionName2();
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>