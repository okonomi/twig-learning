<?php

require_once 'Twig/lib/Twig/Autoloader.php';

Twig_AutoLoader::register();



$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, array(
                                 'cache'       => __DIR__.'/compilation_cache',
                                 'auto_reload' => true,
                             ));

$lexer = new Twig_Lexer($twig, array(
                            'tag_comment'  => array('{*', '*}'),
                            'tag_block'    => array('{', '}'),
                            'tag_variable' => array('{$', '}'),
                        ));
$twig->setLexer($lexer);

$template = $twig->loadTemplate('06.twig');

$template->display(array('name' => 'hoge'));
