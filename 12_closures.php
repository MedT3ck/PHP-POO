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
                <p>Used as callback functions</p>
                
                <!-- Les closures
                ================================================== -->
                <h2>Creation of closures</h2>
                <p class="col-sm-12">
                <?php
                // Declaration of a closure (anonymous function)
                function() { // Display nothing - no interest
                    echo 'Hello world !';
                };
                
                $maFonction = function() {
                    echo '<p>Hello world2 !</p>';
                };
                
                var_dump($maFonction); // Returns an object of type closure
                
                $maFonction(); // Returns Hello world2 !
                
                
                // Example of utilisation
                $addition = function($nombre) {
                    return $nombre + 5;
                };
                
                $listeNombres = [1, 2, 3, 4, 5];
                
                var_dump($listeNombres);
                echo '<br>';
                
                $listeNombres = array_map($addition, $listeNombres);
                
                var_dump($listeNombres);
                echo '<br>';
                
                
                 // Using external variables
                 // The variable can not be changed later
                 // because imported into the closure as soon as
                $quantite = 5;
                $additionneur = function($nbr) use($quantite) {
                    return $nbr + $quantite;
                };

                $listeNbr = [1, 2, 3, 4, 5];

                $listeNbr = array_map($additionneur, $listeNbr);

                var_dump($listeNbr); // retroune le tableau [6, 7, 8, 9, 10]
                echo '<br>';
                
                // So this code is not possible - calculation error
//                $quantite = 5;
//                $additionneur = function($nbr) use($quantite)
//                {
//                  return $nbr + $quantite;
//                };
//
//                $listeNbr = [1, 2, 3, 4, 5];
//
//                $listeNbr = array_map($additionneur, $listeNbr);
//                var_dump($listeNbr);
//                // we have : $listeNbr = [6, 7, 8, 9, 10]
//
//                $quantite = 4;
//
//                $listeNbr = array_map($additionneur, $listeNbr);
//                var_dump($listeNbr);
//                // we have : $listeNbr = [11, 12, 13, 14, 15] in place of [10, 11, 12, 13, 14]
                
                
                // must go through a function with 1 argument
                function creerAdditionneur($quantite) {
                    return function($nbr) use($quantite) {
                        return $nbr + $quantite;
                    };
                }

                $listeNbr2 = [1, 2, 3, 4, 5];

                $listeNbr2 = array_map(creerAdditionneur(5), $listeNbr2);
                var_dump($listeNbr2);
                // Returns $listeNbr2 = [6, 7, 8, 9, 10]
                echo '<br>';

                $listeNbr2 = array_map(creerAdditionneur(4), $listeNbr2);
                var_dump($listeNbr2);
                // Returns $listeNbr = [10, 11, 12, 13, 14]
                echo '<br>';
                ?>
                </p>
                
                
                <h2>Link a closure to an object</h2>
                <p class="col-sm-12">
                <?php
                $additionneur2 = function() {
                    $this->_nbr += 5;
                };

                class MaClasse {

                    private $_nbr = 0;

                    public function nbr() {
                        return $this->_nbr;
                    }

                }

                $obj = new MaClasse;

                  // We get a copy of our closure that will be linked to our object $ obj
                 // This new closure will be called as a method of MyClass
                 // We could just as easily pass $ obj as a second argument
                $additionneur2 = $additionneur2->bindTo($obj, 'MaClasse');
                $additionneur2();

                echo $obj->nbr(); // Display 5
                echo '<br>';
                ?>
                </p>
                
                
                <h2>Link a closure to a class</h2>
                <p class="col-sm-12">
                <?php 
                // Here we declare a static closure
                $additionneur3 = static function() {
                    self::$_nbr += 5;
                };

                class MaClasse3 {

                    private static $_nbr = 0;

                    public static function nbr3() {
                        return self::$_nbr;
                    }

                }

                $additionneur3 = $additionneur3->bindTo(null, 'MaClasse3');
                $additionneur3();

                echo MaClasse3::nbr3();
                echo '<br>';
                ?>
                </p>
                
                
                <h2>Liaisons automatiques - Méthode non statique</h2>
                <p class="col-sm-12">
                <?php
                // Non-static method
                class MaClasse4 {

                    private $_nbr = 0;

                    public function getAdditionneur4() {
                        return function() {
                            $this->_nbr += 5;
                        };
                    }

                    public function nbr() {
                        return $this->_nbr;
                    }

                }

                $obj4 = new MaClasse4;

                $additionneur4 = $obj4->getAdditionneur4();
                $additionneur4();

                echo $obj4->nbr();
                // Display  5 because our closure is well linked to $obj depuis MaClasse4
                echo '<br>';
                ?>
                </p>
                
                
                <h2>Automatic links - Static context</h2>
                <p class="col-sm-12">
                <?php
                // Non-static method
                class MaClasse5 {

                    private static $_nbr = 0;

                    public static function getAdditionneur5() {
                        return function() {
                            self::$_nbr += 5;
                        };
                    }

                    public static function nbr() {
                        return self::$_nbr;
                    }

                }

                $additionneur5 = MaClasse5::getAdditionneur5();
                $additionneur5();

                echo MaClasse5::nbr(); // Display 5
                echo '<br>';
                ?>
                </p>
                
                
                <h2>Implementing the Observer pattern</h2>
                <p class="col-sm-12">
                <?php
                // The observed class
                class Observed implements SplSubject {

                    protected $name;
                    protected $observers = [];

                    public function attach(SplObserver $observer) {
                        $this->observers[] = $observer;
                        return $this;
                    }

                    public function detach(SplObserver $observer) {
                        if (is_int($key = array_search($observer, $this->observers, true))) {
                            unset($this->observers[$key]);
                        }
                    }

                    public function notify() {
                        foreach ($this->observers as $observer) {
                            $observer->update($this);
                        }
                    }

                    public function name() {
                        return $this->name;
                    }

                    public function setName($name) {
                        $this->name = $name;
                        $this->notify();
                    }

                }
                
                // The Observer class whose objects will be instances
                class Observer implements SplObserver {

                    protected $name;
                    protected $closure;

                    public function __construct(Closure $closure, $name) {
                        // Closes the current object and specifies the context to use
                        // (Here it's the same context as $this)
                        $this->closure = $closure->bindTo($this, $this);
                        $this->name = $name;
                    }

                    public function update(SplSubject $subject) {
                        // In case of notification, we recover the closure and we call it
                        $closure = $this->closure;
                        $closure($subject);
                    }

                }
                
                
                // Test the code
                $o = new Observed;

                $observer1 = function(SplSubject $subject) {
                    echo '<p>' . $this->name . ' has been notified! New value of name : ' . $subject->name() . '</p>';
                };

                $observer2 = function(SplSubject $subject) {
                    echo '<p>' . $this->name . ' has been notified! New value of name: ' . $subject->name() . '</p>';
                };

                $o->attach(new Observer($observer1, 'Observer1'))
                        ->attach(new Observer($observer2, 'Observer2'));

                $o->setName('ELRAMOUZ');
                // Which shows:
                // Observer1 has been notified! New value of name: ELRAMOUZ
                // Observer2 has been notified! New value of name: ELRAMOUZ
                ?>
                </p>
            </section>
        </div>
    </body>
</html>