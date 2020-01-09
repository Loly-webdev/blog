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

/* Partial/footer.html.twig */
class __TwigTemplate_efa91e7a5305a0fbb3a5052146ca4f76ed09da9157163a3a0b7b979e80d6b339 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'footer' => [$this, 'block_footer'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        $this->displayBlock('footer', $context, $blocks);
    }

    public function block_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 2
        echo "    <p>
        <strong> © Eloïse RUIZ-RODRIGUEZ | 2020</strong><br>
        Dans le cadre de ma formation avec OpenClassrooms.
    </p>
    <hr>
    <p>
        <a href=\"../../../index.php\">Connexion</a>
    </p>
";
    }

    public function getTemplateName()
    {
        return "Partial/footer.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  45 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Partial/footer.html.twig", "/var/www/blog/Application/View/Partial/footer.html.twig");
    }
}
