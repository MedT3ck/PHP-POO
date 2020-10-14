<?php
class PersonnageTable {
    /*
     * Attributs
     */
    private $_id;
    private $_nom;
    private $_forcePerso;
    private $_degats;
    private $_niveau;
    private $_experience;
    
    /*
     * Méthode de construction
     */
    public function __construct($datas = array()) {
        if (!empty($datas)) {
            $this->hydrate($datas);
        }
    }
    
    
    /*
     * Hydratation de l'objet par Méthode
     */
    public function hydrate(array $datas) {
//        if (isset($datas['id'])) {
//            $this->setId($datas['id']);
//        }
//        
//        if (isset($datas['nom'])) {
//            $this->setNom($datas['nom']);
//        }
//        
//        if (isset($datas['forcePerso'])) {
//            $this->setForcePerso($datas['forcePerso']);
//        }
//        
//        if (isset($datas['degats'])) {
//            $this->setForcePerso($datas['degats']);
//        }
//        
//        if (isset($datas['niveau'])) {
//            $this->setForcePerso($datas['niveau']);
//        }
//        
//        if (isset($datas['experience'])) {
//            $this->setForcePerso($datas['experience']);
//        }
        
        foreach ($datas as $key => $value) {
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        } 
    }
    
    /*
     * Méthodes Accesseurs (Getters) - Pour récupérer la valeur d'un attribut
     */
    public function getId() {
        return $this->_id;
    }
    
    public function getNom() {
        return $this->_nom;
    }
    
    public function getForcePerso() {
        return $this->_forcePerso;
    }
    
    public function getDegats() {
        return $this->_degats;
    }
    
    public function getNiveau() {
        return $this->_niveau;
    }
    
    public function getExperience() {
        return $this->_experience;
    }
    
    
    /*
     * Methods Mutators (Setters) - To modify the value of the attributes
     */
    public function setId($id) {
//        $id = (int) $id; // Convert the argument to an integer
//        if ($id > 0) {// Check - the number must be strictly positive
//            $this->_id = $id; // We  assign the value $ id to the attribute _id
//        }
        $this->_id = (int) $id; //  id is necessarily an integer
    }
    
    public function setNom($nom) {
        if (is_string($nom)) { // Check if there s a string 
            $this->_nom = $nom; // We assign the value $ name to the attribute _name
        }
    }
    
    public function setForcePerso($forcePerso) {
        $forcePerso = (int) $forcePerso;
        if ($forcePerso >= 1 && $forcePerso <= 100) {
            $this->_forcePerso = $forcePerso;
        }
    }
    
    public function setDegats($degats) {
        $degats = (int) $degats;
        if ($degats >= 0 && $degats <= 100) {
            $this->_degats = $degats;
        }
    }
    
    public function setNiveau($niveau) {
        $niveau = (int) $niveau;
        if ($niveau >= 1 && $niveau <= 100) {
            $this->_niveau = $niveau;
        }
    }
    
    public function setExperience($experience) {
        $experience = (int) $experience;
        if ($experience >= 1 && $experience <= 100) {
            $this->_experience = $experience;
        }
    }
}

