<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="MOOC POO - PHP OpenClassrooms">
        <meta name="keywords" content="POO, PHP, Bootstrap">
        <meta name="author" content="Ramouz">
            
        <title>PHP POO - Abstraction and finalization</title>

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
                <h1 class="text-center">PHP POO - Abstraction and finalization</h1>
                <h2>Example 1 - Abstraction - Class and Method</h2>
                <p class="col-sm-12">
                    <?php
                    // Example 1
                    abstract class A { //Class A abstract
                        abstract public function A1($param);
                        
                        public function A2() {
                            // Instructions
                        }
                    }

                    class B extends A { // Class B inheriting from A
                        public function A1($param) {
                            // Instruction
                        }
                    }
                    
                    $ClassB = new B; // No Errors, Class B is not abstract
                    // $ClassA = new A; // Fatal error because Class A is abstract and can not be instantiated
                    
                    ?>
                </p>
                
                
                <h2>Example 2 - Finalization - Class and Method</h2>
                <p class="col-sm-12">
                    <?php
                    // Example 2
                    abstract class C {
                        public function A1($param) {
                            // Instructions
                        }
                        
                        // Prevents access to Child Classes
                        final public function A2() {
                            // Instructions
                        }
                        
                    }
                    
                    final class D extends C {
                        public function A1($param) {
                            // Instructions
                        }
                        
                        // Fatal error because this method is final in the parent Class
                        public function A2() {
                            // Instructions
                        }
                    }
                    
                    // Generates fatal error because Class E can not inherit class D because D is final
                    class E extends D {
                        
                    }
                    
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>