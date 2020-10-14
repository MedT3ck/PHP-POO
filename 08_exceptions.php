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
        <!-- Content section
        ================================================== -->
        <div class="container">
            <section class="row">
                 <h1 class="text-center">POO - PHP Examples</h1>
                <!-- Exceptions
                ================================================== -->
                <h2>Error Handling - Exceptions</h2>
                <p class="col-sm-12">
                    <?php
                    // Example 1
                    function calculSomme($nombre1, $nombre2)
                    {
                        if (!is_numeric($nombre1) || !is_numeric($nombre2)) {
                            // Exception Thrown by Instantiating an Object of the Exception Class
                            throw new Exception('Les 2 paramètres doivent être des nombres.<br>');
                        }
                        
                        return $nombre1 + $nombre2;
                    }
                    
                    // Attempt to perform instructions
                    try
                    {
                        echo calculSomme(18, 3) . '<br>';
                        echo calculSomme('clavier', 54) . '<br>';
                        echo calculSomme(10, 25) . '<br>';
                    }
                    
                    // Catch exceptions if there is an exception
                    catch (Exception $exception)
                    {
                          echo 'Error Message: ' . $exception->getMessage();
                    }
                    
                    echo 'End of the script';
                    
                    ?>
                </p>
                
                
                <!-- Custom Exceptions
                ================================================== -->
                <h2>Error Handling - Custom Exceptions</h2>
                <p class="col-sm-12">
                    <?php
                    // Example 2
                    class PersonnalException extends Exception
                    {
                        public function __construct($message, $code = 0)
                        {
                            parent::__construct($message, $code);
                        }
                        
                        public function __toString()
                        {
                            return $this->message;
                        }
                    }
                    
                    function calculSomme2($nombre1, $nombre2)
                    {
                        if (!is_numeric($nombre1) || !is_numeric($nombre2)) {
                            // Throw custom exception
                            throw new PersonnalException('Les 2 paramètres doivent être des nombres.<br>');
                        }
                        
                        return $nombre1 + $nombre2;
                    }
                    
                    // Attempt to perform instructions
                    try
                    {
                        echo calculSomme2(18, 3) . '<br>';
                        echo calculSomme2('clavier', 54) . '<br>';
                        echo calculSomme2(10, 25) . '<br>';
                    }
                    
                    //Catch exceptions if there is an exception
                    catch (PersonnalException $exception)
                    {
                        echo 'Error Message: ' . $exception . '<br>';
                    }
                    
                 echo 'End of the script';
                    
                    ?>
                </p>
                
                
                <!-- Custom Exceptions - Several Catch
                ================================================== -->
                <h2>Error Handling - Custom Exceptions - Multiple Catch</h2>
                <p class="col-sm-12">
                    <?php
                    // Example 3
                    class PersonnalException2 extends Exception
                    {
                        public function __construct($message, $code = 0)
                        {
                            parent::__construct($message, $code);
                        }
                        
                        public function __toString()
                        {
                            return $this->message;
                        }
                    }
                    
                    function calculSomme3($nombre1, $nombre2)
                    {
                        if (!is_numeric($nombre1) || !is_numeric($nombre2)) {
                            //  Throw custom exception
                            throw new PersonnalException2('The 2 parameters must be numbers.<br>');
                        }
                        
                        if (func_num_args() > 2) {
                                   //  Throw custom exception
                            throw new Exception('Only 2 arguments.<br>');
                        }
                        
                        return $nombre1 + $nombre2;
                    }
                    
                    // Attempt to perform instructions
                    try
                    {
                        echo calculSomme3(18, 3) . '<br>';
                        echo calculSomme3(18, 54, 45) . '<br>';
                        echo calculSomme3(10, 25) . '<br>';
                    }
                    
                    //Catch exceptions if there is an exception
                    catch (PersonnalException2 $exception)
                    {
                        echo 'Error Message [PersonnalException2] : ' . $exception . '<br>';
                    }
                    
                    catch (Exception $exception)
                    {
                        echo 'Error Message [Exception] : ' . $exception->getMessage() . '<br>';
                    }
                    
                    echo 'End of the script';
                    
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>