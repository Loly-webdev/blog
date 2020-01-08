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

/* Front/connexion.html.twig */
class __TwigTemplate_5fb1fdd51fa42aee232af7f60bcb37170fd47f61948c69bddd6903b5e56e49f7 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "Front/template.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("Front/template.html.twig", "Front/connexion.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Connexion";
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "    <section>
        <h3>Connexion :</h3>
        <form class=\"flex\" action=\"#\" method=\"post\">
            <label class=\"space\" for=\"login\">Identifiant :</label>
            <input class=\"space\" id=\"login\" name=\"login\" placeholder=\"Identifiant\" type=\"text\"/>
            <label class=\"space\" for=\"pass\">Mot de passe (8 caractères minimum) :</label>
            <input class=\"space\" id=\"pass\" name=\"pass\" placeholder=\"Mot de passe\" type=\"password\" minlength=\"8\" required/>
            <input class=\"button\" type=\"submit\" value=\"Connexion\"/>
        </form>
    </section>
";
    }

    public function getTemplateName()
    {
        return "Front/connexion.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Front/connexion.html.twig", "/var/www/blog/View/Front/connexion.html.twig");
    }
}
