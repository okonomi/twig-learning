<?php

require_once 'Twig/lib/Twig/Autoloader.php';

Twig_AutoLoader::register();



class Project_Twig_Extension extends Twig_Extension
{
    public function getFilters()
    {
        return array(
            'rot13' => new Twig_Filter_Function('str_rot13'),
        );
    }

    public function getName()
    {
        return 'project';
    }
}



$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, array(
                                 'cache' => __DIR__.'/compilation_cache',
                             ));
$twig->addExtension(new Project_Twig_Extension());

$template = $twig->loadTemplate('index3.html');

$template->display(array());
