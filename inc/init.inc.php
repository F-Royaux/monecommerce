<?php 
//configuration phpdotenv
require __DIR__ . '/../vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();
//--------------BDD
$mysqli = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
if ($mysqli->connect_error) die('Un probléme est survenu lors de la tentative de la connexion à la BDD : ' . $mysqli->connect_error);
// $mysqli->set_charset("uft-8");
//-----------session
session_start();
//---------------- chemin
//
// define ("RACINE_SITE", "http://localhost:4000/");
define("RACINE_SITE", "http://" . $_SERVER['HTTP_HOST']."/");
$contenu = "";
require ('function.inc.php');
// debug($mysqli, 0);
// Déclarer une variable d’environnement
// putenv('NOM_VARIABLE=Le nom de ma variable d\'environnement avec <span style="font-weight:bold;">putenv(NOM_VARIABLE)</span>');
// ou
// $_ENV['NOM_VARIABLE'] = 'Le nom de ma variable d\'environnement avec <span style="font-weight:bold;">$_ENV[NOM_VARIABLE]</span>';