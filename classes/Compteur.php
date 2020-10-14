<?php
/*
 * This simple class calculates the number of times the class is instantiated
 */
class Compteur {
    /*
     * Attributes
     */
    private static $_compteur = 0; // Declaration of the variable / attribute $_compteur
    
    
    /*
     * Construction method
     */
    public function __construct() {
        self::$_compteur++; // Instantiation of the variable $ _counter which belongs to the class so use of self and not $this
    }
    
    
    /*
     * Accessor methods (Getters) - To retrieve the value of an attribute
     */
    // Static getCounter () method that returns the value of the counter - self and not $ this car static
    public static function getCompteur() {
        return self::$_compteur;
    }
}
