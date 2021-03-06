<?php

abstract class Personnage {

	/**
	 * 
	 * @var int
	 * @access protected
	 */
	protected  $atout;

	/**
	 * 
	 * @var int
	 * @access protected
	 */
	protected  $degats;

	/**
	 * Character Strength Management
	 * @var int
	 * @access protected
	 */
	protected  $experience;

	/**
	 * 
	 * @var int
	 * @access protected
	 */
	protected  $force_perso;

	/**
	 * 
	 * @var int
	 * @access protected
	 */
	protected  $id;

	/**
	 * 
	 * @var int
	 * @access protected
	 */
	protected  $niveau;

	/**
	 * 
	 * @var string
	 * @access protected
	 */
	protected  $nom;

	/**
	 * 
	 * @var int
	 * @access protected
	 */
	protected  $nombre_coups;

	/**
	 * 
	 * @var int
	 * @access protected
	 */
	protected  $time_connexion;

	/**
	 * 
	 * @var int
	 * @access protected
	 */
	protected  $time_coups;

	/**
	 * 
	 * @var int
	 * @access protected
	 */
	protected  $time_endormi;

	/**
	 * 
	 * @var string
	 * @access protected
	 */
	protected  $type;


	/**
	 * Hydration method
	 * @access public
	 * @param array $donnees 
	 * @return void
	 */

	public final  function __construct($donnees) {

	}


	/**
	 * @access public
	 * @return bool
	 */

	public final  function estEndormi() {

	}


	/**
	 * @access public
	 * @param Personnage $perso 
	 * @return int
	 */

	public final  function frapper(Personnage $perso) {

	}


	/**
	 * @access public
	 * @return void
	 */

	public final  function gagnerExperience() {

	}


	/**
	 * @access public
	 * @param array $donnees 
	 * @return void
	 */

	public final  function hydrate($donnees) {

	}


	/**
	 * @access public
	 * @return bool
	 */

	public final  function nomValide() {

	}


	/**
	 * @access public
	 * @return void
	 */

	public final  function perdreDegats() {

	}


	/**
	 * @access public
	 * @param int $force 
	 * @return int
	 */

	public final  function recevoirDegats($force) {

	}


	/**
	 * @access public
	 * @return string
	 */

	public final  function reveil() {

	}


}
?>