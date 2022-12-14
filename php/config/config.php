<?php
session_start();

//Affichage des erreurs et avertissements PHP
error_reporting(E_ALL);
ini_set("display_errors", 1);

//define('nb_articles_par_page', 2);

//Fonction debug
function print_r2($tab_a_afficher_print_r)
{
    echo '<pre>';
    print_r($tab_a_afficher_print_r);
    echo '</pre>';
}

function loadClass($class)
{
    if (is_file("classes/" . $class . ".class.php")) {
        require_once("classes/" . $class . ".class.php");
    }
}

spl_autoload_register("loadClass");
define('nb_articles_par_page', 2);

require_once 'bdd.conf.php';
require_once './vendor/autoload.php';
//require_once 'vendor/autoload.php';
