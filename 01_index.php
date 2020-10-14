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
        <section class="container">

            <section class="row">
                <h1 class="text-center">POO - PHP Examples</h1>
                <h2>Character</h2>
                <p class="col-sm-12">
                    <?php
                    /*
                     * require 'classes/Personnage.php';             // Include class
                     * OU
                     * Auto-load function of all classes of the project
                     * 
                     * The function loads all the classes needed by the project
                     * if the classes are placed in the classes folder
                     */
                    function chargerMaClasse($classe) {
                        require 'classes/' . $classe . '.php';
                    }
                    
                    spl_autoload_register('chargerMaClasse');
                    
                    //$perso1 = new Personnage(60, 0);                      // Creating the Character Object - Creating an Instance of the Character Class
                    //$perso2 = new Personnage(100, 10);                    // Creating a 2nd character
                    $perso1 = new Personnage(Personnage::FORCE_MOYENNE, 0); // Creating the character object with a constant
                    $perso2 = new Personnage(Personnage::FORCE_GRANDE, 10); //  Creating a 2nd character
                    
                    //$perso1->setForce(10);
                    //$perso1->setExperience(2);
                    
                    //$perso2->setForce(90);
                    //$perso2->setExperience(58);
                    
                    //$perso1->parler();    // Appel de la méthode test parler()
                    Personnage::parler();   // Appel de la méthode statique parler()
                    
                    echo '<strong> Before the fight :</strong><br>';
                    echo 'The character 1 has'. $ perso1-> experience(). 'experience';
                    echo 'The character 2 has'. $ perso2-> experience(). 'experience';
                    echo 'The character 1 has'. $ custom1-> force(). 'forcibly and the character 2 has'. $ perso2-> force(). 'of force. <br>';
                    
                    echo '<strong> The fight starts ... </ strong> <br>';
                    echo 'Character 1 strikes character 2 ... <br>';
                    echo 'Character 1 gains experience ... <br>';

                    $perso1->frapper($perso2);                     // Character 1 hits the character 2
                    $perso1->gagnerExperience();                   // Character 1 gains experience
                    
                    echo 'Character 2 strikes the character 1 ... <br>';
                    echo 'Character 2 gains experience ... <br>';

                    $perso2->frapper($perso1);                     // Character 2 hits the character 1
                    $perso2->gagnerExperience();                   // Character 2 gains experience
                    
                     echo '<strong> After the fight: </ strong> <br>';
                     echo 'The character 1 has'. $ perso1-> experience(). 'experience and character 2 a'. $ perso2-> experience(). 'experience. <br />';
                     echo 'The character 1 has'. $ perso1-> degats(). 'of damage unlike the character 2 who has'. $ perso2-> degats(). 'of damage. <br>';

                    ?>
                </p>
                <h2>Counter</h2>
                <p>
                    <?php
                    // Instanciation de 3 tests compteur
                    $test1 = new Compteur;
                    $test2 = new Compteur;
                    $test3 = new Compteur;
                    
                  echo 'The class is instantiated:'. Compteur::getCompteur() . ' times.';
                    ?>
                </p>
                <h2>Manipulate data from a DB</h2>
                <p>
                    <?php
                    include_once 'configuration/configurationPDO.php';
                    $req = $bdd->query('SELECT id, nom, forcePerso, degats, niveau, experience
                                          FROM PersonnagesTable');
                    
                  // Show each character data in an array
                    while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
                        $perso = new PersonnageTable($datas);
                        
                        echo '<pre>';
                            print_r($datas);
                            print_r($perso);
                        echo '</pre>';
                        
                        echo $perso->getNom() . ' a ' .
                             $perso->getForcePerso() . ' Of force, ' .
                             $perso->getDegats() . ' Of Dammage, ' .
                             $perso->getExperience() . 'experience / level' .
                             $perso->getNiveau() . '<br><br><br>';
                    }
                    
                    $req->closeCursor();       // Close the cursor, allowing the query to be executed again                      
                    $bdd = null;                // Closing the connection to the base
                    ?>
                </p>
            	 <h2> Manipulate DB data with a Manager class </ h2>
                <p>
                    <?php
                    $db = new ConfigurationPDO(); // Using a class to connect to the database
                    $bdd = $db->bdd();
                    $manager = new PersonnagesTableManager($bdd);
                    
                    // Character creation to test the method  addPersonnage()
                    $perso1 = new PersonnageTable([
                        'nom'           => 'YodaBoss',
                        'forcePerso'    => 5,
                        'degats'        => 0,
                        'niveau'        => 1,
                        'experience'    => 1
                    ]);
                    
                    
                    // Tests the methods of the Manager
                    $manager->addPersonnage($perso1);
                    $manager->getPersonnage(2);
                    $manager->getListPersonnages();
                    
                    // Create an instance of CharacterTable to test updatePersonnage
                    $persoToUpdate = new PersonnageTable([
                        'forcePerso'    => 10,
                        'degats'        => 20,
                        'niveau'        => 2,
                        'experience'    => 20,
                        'id'            => 6
                    ]);
                    
                    $manager->updatePersonnage($persoToUpdate);
                    
                    
                    // Create an instance of CharacterTable to test deletePersonnage
                    $perso3 = new PersonnageTable(['id' => 12]);
                    
                    $manager->deletePersonnage($perso3);
                    
                    
                   // Display test result
                    echo '<h3>getPersonnage id = 2</h3>';
                    echo '<pre>';
                        print_r($manager->getPersonnage(2));
                    echo '</pre>';
                    
                    echo '<h3>getListPersonnages</h3>';
                    echo '<pre>';
                        print_r($manager->getListPersonnages());
                    echo '</pre>';                    
                    
                    $bdd = null;
                    ?>
                </p>
            </section>

        </section>
    </body>
</html>
