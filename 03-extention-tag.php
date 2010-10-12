<?php

require_once 'Twig/lib/Twig/Autoloader.php';

Twig_AutoLoader::register();



class Project_Twig_Extension extends Twig_Extension
{
    public function getTokenParsers()
    {
        return array(new Project_Set_TokenParser());
    }

    public function getName()
    {
        return 'project';
    }
}


class Project_Set_TokenParser extends Twig_TokenParser
{
    public function parse(Twig_Token $token)
    {
        $lineno = $token->getLine();
        $name = $this->parser->getStream()->expect(Twig_Token::NAME_TYPE)->getValue();
        $this->parser->getStream()->expect(Twig_Token::NAME_TYPE, '=');
        $value = $this->parser->getExpressionParser()->parseExpression();

        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

        return new Project_Set_Node($name, $value, $lineno, $this->getTag());
    }

    public function getTag()
    {
        return 'set';
    }
}


class Project_Set_Node extends Twig_Node
{
    public function __construct($name, Twig_Node_Expression $value, $lineno)
    {
        parent::__construct(array('value' => $value), array('name' => $name), $lineno);
    }

    public function compile($compiler)
    {
    $compiler
        ->addDebugInfo($this)
        ->write('$context[\''.$this['name'].'\'] = ')
        ->subcompile($this->value)
        ->raw(";\n")
        ;
    }
}



$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, array(
                                 'cache' => __DIR__.'/compilation_cache',
                             ));
$twig->addExtension(new Project_Twig_Extension());

$template = $twig->loadTemplate('index2.html');

$template->display(array('name' => 'Fabien'));
