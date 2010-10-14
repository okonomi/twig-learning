<?php

require_once 'Twig/lib/Twig/Autoloader.php';

Twig_AutoLoader::register();


$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, array(
                                 'cache' => __DIR__.'/compilation_cache',
                             ));

$template = $twig->loadTemplate('02.twig');

$template->display(array('name' => 'Fabien'));
