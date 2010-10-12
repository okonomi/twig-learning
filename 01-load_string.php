<?php

require_once 'Twig/lib/Twig/Autoloader.php';

Twig_AutoLoader::register();


$loader = new Twig_Loader_String();
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('Hello {{ name }}!');

$template->display(array('name' => 'Fabien'));






