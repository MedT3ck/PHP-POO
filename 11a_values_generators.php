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
                <p>Return values with yield</p>
                
                <!--The generators
                ================================================== -->
                <h2>Return keys with values</h2>
                <p class="col-sm-12">
                    <?php
                    function generator() {
                        for ($i = 0; $i < 10; $i++) {
                            yield 'Itération n°' . $i;
                        }
                    }
                    
                    foreach (generator() as $key => $val) {
                        echo $key . ' => ' . $val . '<br>';
                    }
                    ?>
                </p>    
                
                    
                <h2>Change the key associated with the value</h2>
                <p class="col-sm-12">
                    <?php
                    function generator2() {
                        yield 'a' => 'Iteration 1';
                        yield 'b' => 'Iteration 2';
                        yield 'c' => 'Iteration 3';
                        yield 'd' => 'Iteration 4';
                    }
                    
                    foreach (generator2() as $key2 => $val2) {
                        echo $key2 . ' => ' . $val2 . '<br>' ;
                    }
                    ?>
                </p>
                
                
                <h2>Return a reference</h2>
                <p class="col-sm-12">
                    <?php
                    class MyClassName {
                        protected $myAttribut;
                        
                        public function __construct() {
                            $this->myAttribut = ['refUn', 'refDeux', 'refTrois', 'refQuatre'];
                        }
                        
                        // The & before the generator name indicates that the returned values are references
                        public function &generator3() {
                            // We seek here to obtain the references of the values of the table to return them
                            foreach ($this->myAttribut as &$value) {
                                yield $value;
                            }
                        }
                        
                        public function myAttribut() {
                            return $this->myAttribut;
                        }
                    }
                    
                    $object = new MyClassName;
                    
                    // We go through our generator collecting the entries by reference
                    foreach ($object->generator3() as &$value) {
                        
                        //var_dump($value);
                        
                        // We perform some operation on our value
                        $value = strrev($value);
                        
                    }
                    
                    echo '<pre>';
                        var_dump($object->myAttribut());
                    echo '</pre>';
                    ?>
                </p>
                
            </section>
        </div>
    </body>
</html>