<?php
class Personnage {
    /*
     * Attributes
     */
    private $_force;           // The strength of the character
    private $_localisation;    // His location
    private $_experience;      // His experience
    private $_degats;          // His damage
    
    /*
     * Attributes / static variables
     */
    private static $_leTexte = '<strong>Static attribute: </ strong> I am your little Padawan father !!!<br>';

    /*
     * Declaration of Force Constants
     */
    const FORCE_PETITE  = 20;
    const FORCE_MOYENNE = 50;
    const FORCE_GRANDE  = 80;
    
    /*
     * Construction method
     */
    public function __construct($forceInitiale, $degats) {
        //echo 'Here is the constructor !';       // Test Message  
        $this->setForce($forceInitiale);        // Initialization of the force
        $this->setDegats($degats);              // Initialization of the damage
        $this->_experience = 1;                 // Initialization of the experience to 1
    }


    /*
     * Methodes
     */
    // Simple method test display text
    // public function speak () {
    // echo 'I am character 1, virtual character RD2D. <br> The force is with me! <br>';
    //}
    
     // Method of managing the strike according to the strength of the character
    public function deplacer() {
         
    }
    
        // Method of managing the strike according to the strength of the character
    public function frapper(Personnage $persoAFrapper) {
        $persoAFrapper->_degats += $this->_force;
    }
    
     // How to manage the character experience
    public function gagnerExperience() {
        $this->_experience ++;  // Incrémente l'expérience
    }
    
    
    /*
     * Method   (Getters) - To retrieve the value of an attribute
     */
    // Force () method that returns the contents of the $ _force attribute
    public function force() {
        return $this->_force; 
    }
    
    // Method experiment () that returns the contents of the attribute $ _ecperience
    public function experience() {
        return $this->_experience;
    }
    
    // Method damage () that returns the contents of the $ _degats attribute
    public function degats() {
        return $this->_degats;
    }
    
    
    /*
     * Mutator Methods - To change the value of attributes
     */
    // Mutator that modifies the $ _force attribute
    public  function setForce($force) {
//        if (!is_int($force)) { // If it's not an integer.
//            trigger_error('The strength of a character must be an integer', E_USER_WARNING);
//            return;
//        }
//
//        if ($force > 100) { // We check that we do not want to assign a value greater than 100.
//            trigger_error('The strength of a character can not exceed 100', E_USER_WARNING);
//            return;
//        }
//        
//        $this->_force = $force;
        
        if (in_array($force, [self::FORCE_PETITE, self::FORCE_MOYENNE, self::FORCE_GRANDE])) {
            $this->_force = $force;
        }
    }
    
     // Mutator responsible for modifying the attribute $ _experience.
    public function setExperience($experience) {
        if (!is_int($experience)) { // If it's not an integer.
            trigger_error('The experience of a character must be an int ', E_USER_WARNING);
            return;
        }

        if ($experience > 100) { // We check that we do not want to assign a value greater than 100.
            trigger_error('The experience of a character must be smaller than 100', E_USER_WARNING);
            return;
        }

        $this->_experience = $experience;
    }
    
    public function setDegats($degats) {
        if (!is_int($degats)) { // If it's not an integer.
            trigger_error('The damage level of a character must be an int', E_USER_WARNING);
            return;
        }

        $this->_degats = $degats;
    }
    
    
    /*
     * Static methods - To act on a class and not on an object
     */
    public static function parler() {
        //echo '<strong> Staitic method: :</strong> I'm your father !!!<br>';
        echo self::$_leTexte; // Call the static attribute
    }
}


/*
 * Heritage
 */
class Magicien extends Personnage {
    private $_magie; // magic spell power out of 100
    
    public function lancerUnSort($perso) {
        $perso->recevoirDegats($this->_magie);
    }
    
   //  redefine the winExperience method
    public function gagnerExperience() {
        parent::gagnerExperience(); // call the winExperience () method of the parent class
        
        if ($this->_magie < 100) {
            $this->_magie += 10;
        }
    }
}

class Guerrier extends Personnage {
    
}

class Brute extends Personnage {
    
}