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

/* Partial/head.html.twig */
class __TwigTemplate_a79863c6a42a6409c399be63eb9727bdce30515c9f34ac1ed01a7cd90bdb731b extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        $this->displayBlock('head', $context, $blocks);
    }

    public function block_head($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 2
        echo "    <meta charset=\"UTF-8\">
    <!-- Favicon -->
    <link href=\"../../Public/images/favicon.png\" rel=\"icon\" type=\"image/png\"/>
    <!-- Css files -->
    <link href=\"../../Public/css/style.css\" rel=\"stylesheet\"/>
    <!--Viewport -->
    <meta content=\"width=device-width, initial-scale=1.0\" name=\"viewport\">
    <!-- Meta description -->
    <meta content=\"Mon blog professionnel\" name=\"description\">
    <meta content=\"Eloïse RUIZ-RODRIGUEZ\" name=\"author\">
    <!-- Fonts -->
    <link href=\"https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap|Roboto|Open+Sans\" rel=\"stylesheet\">

";
    }

    public function getTemplateName()
    {
        return "Partial/head.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  45 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Partial/head.html.twig", "/var/www/blog/View/Partial/head.html.twig");
    }
}
