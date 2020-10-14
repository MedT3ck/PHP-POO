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
                <h1 class="text-center">POO - PHP Design patterns</h1>
                <!-- Pattern Factory
                ================================================== -->
                <h2>Pattern Factory</h2>
                <p class="col-sm-12">
                    <?php
                    class DBFactory {

                        public static function load($sgbdr) {
                            $classe = 'SGBDR_' . $sgbdr;

                            if (file_exists($chemin = $classe . '.class.php')) {
                                require $chemin;
                                return new $classe;
                            } else {
                                throw new RuntimeException(' class <strong>' . $classe . '</strong> couldnt be found !');
                            }
                        }

                    }
                    ?>
                    
                    <?php // Use in a script
                    try {
                        $mysql = DBFactory::load('MySQL');
                    } catch (RuntimeException $e) {
                        echo $e->getMessage();
                    }
                    ?>
                </p>
                
                
                <p<strong>A concrete example :</strong> create a class that will distribute PDO objects easily. Several DBs with different identifiers. We must centralize the whole in a class</p>
                <p class="col-sm-12">
                    <?php
                    class PDOFactory {

                        public static function getMysqlConnexion() {
                            $db = new PDO('mysql:host=localhost;dbname=tests', 'root', '');
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            return $db;
                        }

                        public static function getPgsqlConnexion() {
                            $db = new PDO('pgsql:host=localhost;dbname=tests', 'root', '');
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            return $db;
                        }

                    }
                    ?>
                </p>
                
                
                <!-- Pattern Observer
                ================================================== -->
                <h2>The Observer pattern</h2>
                <p>Listen to objects</p>
                <p class="col-sm-12">
                    <?php
                    // Class from which the observed objects will be derived
                    class Observee implements SplSubject {

                        // This is the painting that will contain all the objects that observe us.
                        protected $observers = [];
                        // As soon as this attribute changes, the observer classes will be notified.
                        protected $nom;

                        public function attach(SplObserver $observer) {
                            $this->observers[] = $observer;
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

                        public function getNom() {
                            return $this->nom;
                        }

                        public function setNom($nom) {
                            $this->nom = $nom;
                            $this->notify();
                        }

                    }
                    
                    // 2 classes whose objects will be observers
                    class Observer1 implements SplObserver {

                        public function update(SplSubject $obj) {
                            echo __CLASS__, ' has been notified! New attribute value <strong>nom</strong> : ', $obj->getNom();
                        }

                    }

                    class Observer2 implements SplObserver {

                        public function update(SplSubject $obj) {
                            echo __CLASS__, ' has been notified! New attribute value <strong>nom</strong> : ', $obj->getNom();
                        }

                    }
                    
                    // Test classes
                    $o = new Observee;
                    $o->attach(new Observer1); // Add an observer.
                    $o->attach(new Observer2); // Add another observer.
                    $o->setNom('Victor'); // The name is changed to see if the observer classes have been notified.
                    
                    // Another method - fast
//                    $o = new Observee;
//
//                    $o->attach(new Observer1)
//                      ->attach(new Observer2)
//                      ->attach(new Observer3)
//                      ->attach(new Observer4)
//                      ->attach(new Observer5);
//
//                    $o->setNom('Victor'); // The name is changed to see if the observer classes have been notified.
                    
                    
                    ?>
                </p>
                
                <p><strong>A concrete example:</strong>intercept errors</p>
                <p class="col-sm-12">
                    <?php
                    // As part of a project -> one file per class - a class autoloader
                    // ErrorHandler : class handling errors
                    class ErrorHandler implements SplSubject {

                        // This is the painting that will contain all the objects that observe us.
                        protected $observers = [];
                        // Attribute that will contain our formatted error.
                        protected $formatedError;

                        public function attach(SplObserver $observer) {
                            $this->observers[] = $observer;
                            return $this;
                        }

                        public function detach(SplObserver $observer) {
                            if (is_int($key = array_search($observer, $this->observers, true))) {
                                unset($this->observers[$key]);
                            }
                        }

                        public function getFormatedError() {
                            return $this->formatedError;
                        }

                        public function notify() {
                            foreach ($this->observers as $observer) {
                                $observer->update($this);
                            }
                        }

                        public function error($errno, $errstr, $errfile, $errline) {
                            $this->formatedError = '[' . $errno . '] ' . $errstr . "\n" . 'File : ' . $errfile . ' (ligne ' . $errline . ')';
                            $this->notify();
                        }

                    }
                    
                    
                    // MailSender : class taking care of sending the mails
                    class MailSender implements SplObserver {

                        protected $mail;

                        public function __construct($mail) {
                            if (preg_match('`^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$`', $mail)) {
                                $this->mail = $mail;
                            }
                        }

                        public function update(SplSubject $obj) {
                            mail($this->mail, 'Error detected! ',' An error has been detected on the site. Here is the information of it: ' . "\n" . $obj->getFormatedError());
                        }

                    }
                    
                    
                    // BDDWriter : class taking care of DB registration
                    class BDDWriter implements SplObserver {

                        protected $db;

                        public function __construct(PDO $db) {
                            $this->db = $db;
                        }

                        public function update(SplSubject $obj) {
                            $q = $this->db->prepare('INSERT INTO erreurs SET erreur = :erreur');
                            $q->bindValue(':erreur', $obj->getFormatedError());
                            $q->execute();
                        }

                    }
                    
                    
                    // Test code
                    $o = new ErrorHandler; // We create a new error handler.
                    $db = PDOFactory::getMysqlConnexion();

                    $o->attach(new MailSender('login@f.ty'))
                            ->attach(new BDDWriter($db));

                    set_error_handler([$o, 'error']); // It will be by the error () method of the ErrorHandler class that the errors must be processed.

                    5 / 0; // generating an error
                    ?>
                </p>
                
                
                <!-- Pattern Strategy
                ================================================== -->
                <h2>Pattern Strategy</h2>
                <p>Separate algorithms</p>
                <p class="col-sm-12">
                    <?php
                    // Création de l'interface
                    interface Formater {

                        public function format($text);
                    }
                    
                    
                    // Creation of abstract class writer
                    abstract class Writer {

                        // Attribute containing the instance of the trainer that you want to use.
                        protected $formater;

                        abstract public function write($text);

                        // We want an instance of a class implementing Format as parameter.
                        public function __construct(Formater $formater) {
                            $this->formater = $formater;
                        }

                    }
                    
                    
                    // 2 classes that inherit from Writer: FileWriter and DBWriter
                    class FileWriter extends Writer {

                        // Attribute storing the file path.
                        protected $file;

                        public function __construct(Formater $formater, $file) {
                            parent::__construct($formater);
                            $this->file = $file;
                        }

                        public function write($text) {
                            $f = fopen($this->file, 'w');
                            fwrite($f, $this->formater->format($text));
                            fclose($f);
                        }

                    }

                    class DBWriter extends Writer {

                        protected $db;

                        public function __construct(Formater $formater, PDO $db) {
                            parent::__construct($formater);
                            $this->db = $db;
                        }

                        public function write($text) {
                            $q = $this->db->prepare('INSERT INTO lorem_ipsum SET text = :text');
                            $q->bindValue(':text', $this->formater->format($text));
                            $q->execute();
                        }

                    }
                    
                    
                    // The 3 trainers
                    class TextFormater implements Formater {

                        public function format($text) {
                            return 'Date : ' . time() . "\n" . 'Text : ' . $text;
                        }

                    }

                    class HTMLFormater implements Formater {

                        public function format($text) {
                            return '<p>Date : ' . time() . '<br />' . "\n" . 'Text : ' . $text . '</p>';
                        }

                    }

                    class XMLFormater implements Formater {

                        public function format($text) {
                            return '<?xml version="1.0" encoding="ISO-8859-1"?>' . "\n" .
                                    '<message>' . "\n" .
                                    "\t" . '<date>' . time() . '</date>' . "\n" .
                                    "\t" . '<texte>' . $text . '</texte>' . "\n" .
                                    '</message>';
                        }

                    }
                    
                    
                    // Tester le code
                    function autoload($class) {
                        if (file_exists($path = $class . '.php')) {
                            require $path;
                        }
                    }

                    spl_autoload_register('autoload');

                    $writer = new FileWriter(new HTMLFormater, 'file.html');
                    $writer->write('Hello world !');
                    ?>
                </p>
                
                
                <!-- Pattern Singleton
                ================================================== -->
                <h2> Pattern Singleton</h2>
                <p>A class, an instance - Instantiate a class only once - Never implement a singleton to use as a global variable</p>
                <p class="col-sm-12">
                    <?php
                    class MonSingleton {

                        protected static $instance; // Will hold the instance of our class.

                        protected function __construct() {
                            
                        }

                        // Private builder - prohibit access to the clone method

                        protected function __clone() {
                            
                        }

                        // Private cloning method too.

                        public static function getInstance() {
                            if (!isset(self::$instance)) { // If we have not instantiated our class yet.
                                self::$instance = new self; // We instantiate ourselves. :)
                            }

                            return self::$instance;
                        }

                    }
                    
                    // Using the class
                    $obj = MonSingleton::getInstance(); // First call: created instance.
                    $obj->methode1();
                    ?>
                </p>
                
                
                <!-- Pattern Injection of dependencies
                ================================================== -->
                <h2>Pattern Injection of dependencies</h2>
                <p>Decouple classes</p>
                <p class="col-sm-12">
                    <?php
                    // Code Listing - Singleton - Bad Method
                    class NewsManager {

                        public function get($id) {
                            // It is assumed that MyPDO extends PDO and implements a singleton.
                            $q = MyPDO::getInstance()->query('SELECT id, auteur, titre, contenu FROM news WHERE id = ' . (int) $id);

                            return $q->fetch(PDO::FETCH_ASSOC);
                        }

                    }
                    
                    // Good method
                    interface iDB {
                        // Query method
                        public function query($query);
                    }
                    
                    interface iResult {

                        public function fetchAssoc();
                    }
                    
                    // The 4 classes
                    class MyPDO extends PDO implements iDB {

                        public function query($query) {
                            return new MyPDOStatement(parent::query($query));
                        }

                    }

                    class MyPDOStatement implements iResult {

                        protected $st;

                        public function __construct(PDOStatement $st) {
                            $this->st = $st;
                        }

                        public function fetchAssoc() {
                            return $this->st->fetch(PDO::FETCH_ASSOC);
                        }

                    }

                    class MyMySQLi extends MySQLi implements iDB {

                        public function query($query) {
                            return new MyMySQLiResult(parent::query($query));
                        }

                    }

                    class MyMySQLiResult implements iResult {

                        protected $st;

                        public function __construct(MySQLi_Result $st) {
                            $this->st = $st;
                        }

                        public function fetchAssoc() {
                            return $this->st->fetch_assoc();
                        }

                    }
                    
                    // The NewsManager class
                    class NewsManager2 {

                        protected $dao;

                        //We want an object that instantiates a class that implements iDB.
                        public function __construct(iDB $dao) {
                            $this->dao = $dao;
                        }

                        public function get($id) {
                            $q = $this->dao->query('SELECT id, auteur, titre, contenu FROM news WHERE id = ' . (int) $id);

                            // We check that the result implements welliResult.
                            if (!$q instanceof iResult) {
                                throw new Exception('The result of a query must be an implementing object iResult');
                            }

                            return $q->fetchAssoc();
                        }

                    }
                    
                    // Test code
                    $dao = new MyPDO('mysql:host=localhost;dbname=news', 'root', '');
// $dao = new MyMySQLi('localhost', 'root', '', 'news');

                    $manager = new NewsManager($dao);
                    print_r($manager->get(2));
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>