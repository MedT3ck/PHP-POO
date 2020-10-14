<?php
class PersonnagesTableManager {
    /*
     * Attributes
     */
    private $_bdd;
    
    
    /*
     * Construction method
     */
    public function __construct($bdd) {
        $this->setDb($bdd);
    }
    
    
    /*
     * CRUD Methodes 
     */
     
    /*  Insertion Method of a character in the DB
      * To avoid the error message Strict Standards: Only variables should be passed by reference
      * use bindValue and not bind Param
      */
    
    public function addPersonnage(PersonnageTable $perso) {
        $req = $this->_bdd->prepare('INSERT INTO PersonnagesTable
                                             SET nom        = :nom,
                                                 forcePerso = :forcePerso,
                                                 degats     = :degats,
                                                 niveau     = :niveau,
                                                 experience = :experience
                                    ');
        
        $req->bindValue(':nom',         $perso->getNom(),           PDO::PARAM_STR);
        $req->bindValue(':forcePerso',  $perso->getForcePerso(),    PDO::PARAM_INT);
        $req->bindValue(':degats',      $perso->getDegats(),        PDO::PARAM_INT);
        $req->bindValue(':niveau',      $perso->getNiveau(),        PDO::PARAM_INT);
        $req->bindValue(':experience',  $perso->getExperience(),    PDO::PARAM_INT);
        
        $req->execute();
        
        $req->closeCursor();
    }
    
    // Suppression Method of a character in the DB
    public function deletePersonnage(PersonnageTable $perso) {
        $this->_bdd->exec('DELETE FROM PersonnagesTable WHERE id = ' . $perso->getId());
    }
    
    // Selection Method of a character in the DB w/ WHERE 
  
    public function getPersonnage($id) {
        $id = (int) $id;
        
        $req = $this->_bdd->query('SELECT id, nom, forcePerso, degats, niveau, experience 
                                    FROM PersonnagesTable
                                   WHERE id = '. $id);
        $datas = $req->fetch(PDO::FETCH_ASSOC);
        //var_dump($datas);
        return new PersonnageTable($datas);
        
        $req->closeCursor();
    }   
    
    // Method of selecting the entire list of characters
    public function getListPersonnages() {
        $persos = [];
        
        $req = $this->_bdd->query('SELECT id, nom, forcePerso, degats, niveau, experience 
                                    FROM PersonnagesTable
                                   ORDER BY nom');
        
        while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
            $persos[] = new PersonnageTable($datas);
        }
        //var_dump($persos);
        return $persos;
        
        $req->closeCursor();
    }
    //  Update Method  of a character in the database
 
    public function updatePersonnage(PersonnageTable $perso) {
        $req = $this->_bdd->prepare('UPDATE PersonnagesTable
                                        SET forcePerso = :forcePerso,
                                            degats     = :degats,
                                            niveau     = :niveau,
                                            experience = :experience
                                      WHERE id         = :id
                                    ');
        
        $req->bindValue(':forcePerso',  $perso->getForcePerso(),    PDO::PARAM_INT);
        $req->bindValue(':degats',      $perso->getDegats(),        PDO::PARAM_INT);
        $req->bindValue(':niveau',      $perso->getNiveau(),        PDO::PARAM_INT);
        $req->bindValue(':experience',  $perso->getExperience(),    PDO::PARAM_INT);
        $req->bindValue(':id',          $perso->getId(),            PDO::PARAM_INT);
        
        $req->execute();
        
        $req->closeCursor();
    }
    
    
    /*
     * Methods Mutators (Setters) - To modify the value of the attributes
     */
    public function setDb(PDO $bdd) {
        $this->_bdd = $bdd;
    }
}