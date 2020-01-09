<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* Front/template.html.twig */
class __TwigTemplate_5791644d49edc32c58d993678039cebb666cea24bbd1dc3523fd0e1f0928a439 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'head' => [$this, 'block_head'],
            'title' => [$this, 'block_title'],
            'nav' => [$this, 'block_nav'],
            'content' => [$this, 'block_content'],
            'footer' => [$this, 'block_footer'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    ";
        // line 4
        $this->displayBlock('head', $context, $blocks);
        // line 8
        echo "</head>
<body>

<header>
        ";
        // line 12
        $this->displayBlock('nav', $context, $blocks);
        // line 15
        echo "</header>

<main>
        ";
        // line 18
        $this->displayBlock('content', $context, $blocks);
        // line 19
        echo "</main>

<footer>
        ";
        // line 22
        $this->displayBlock('footer', $context, $blocks);
        // line 25
        echo "</footer>

</body>
</html>";
    }

    // line 4
    public function block_head($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 5
        echo "        ";
        echo twig_include($this->env, $context, "Partial/head.html.twig");
        echo "
        ";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        // line 7
        echo "    ";
    }

    // line 6
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 12
    public function block_nav($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 13
        echo "                ";
        echo twig_include($this->env, $context, "Partial/nav.html.twig");
        echo "
        ";
    }

    // line 18
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 22
    public function block_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 23
        echo "            ";
        echo twig_include($this->env, $context, "Partial/footer.html.twig");
        echo "
        ";
    }

    public function getTemplateName()
    {
        return "Front/template.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  120 => 23,  116 => 22,  110 => 18,  103 => 13,  99 => 12,  93 => 6,  89 => 7,  87 => 6,  82 => 5,  78 => 4,  71 => 25,  69 => 22,  64 => 19,  62 => 18,  57 => 15,  55 => 12,  49 => 8,  47 => 4,  42 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Front/template.html.twig", "/var/www/blog/Application/View/Front/template.html.twig");
    }
}
