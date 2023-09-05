<?php 
//--------------BDD
$mysqli = new mysqli("localhost", "db_user", "1234", "monecommerce");
if ($mysqli->connect_error) die('Un probléme est survenu lors de la tentative de la connexion à la BDD : ' . $mysqli->connect_error);
// $mysqli->set_charset("uft-8");
//-----------session
session_start();
//---------------- chemin
//
// define ("RACINE_SITE", "http://localhost:4000/");
define("RACINE_SITE", "http://" . $_SERVER['HTTP_HOST']."/");