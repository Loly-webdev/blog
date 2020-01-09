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

/* Partial/nav.html.twig */
class __TwigTemplate_9e4a809edf7abf1994b83684e4d89b1a91ee4f37e765c8c3cb1f62a8ba5b4260 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'nav' => [$this, 'block_nav'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        $this->displayBlock('nav', $context, $blocks);
    }

    public function block_nav($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 2
        echo "    <nav class=\"flex\">
        <a href=\"../../../index.php\"><img alt=\"logo du blog Eloïse\" src=\"../../../Public/images/logo_blanc.png\" href=\"/home\"></a>
        <ul class=\"flex\">
            <li><a href=\"../../../index.php\">Accueil</a></li>
            <li><a href=\"../../../index.php\">Blog</a></li>
            <li><a href=\"../../../index.php\">Contact</a></li>
            <li><a href=\"../../../index.php\">Connexion</a></li>
        </ul>
    </nav>
";
    }

    public function getTemplateName()
    {
        return "Partial/nav.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  45 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Partial/nav.html.twig", "/var/www/blog/Application/View/Partial/nav.html.twig");
    }
}
