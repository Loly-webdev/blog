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

/* Front/contact.html.twig */
class __TwigTemplate_2b8afc1470f5ff69fded6d1f568797c30d5acdd5cb594ff110637b1cf0637378 extends Template
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
        $this->parent = $this->loadTemplate("Front/template.html.twig", "Front/contact.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Contact";
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "    <section>
        <h3>Contactez-moi :</h3>
        <form class=\"flex\" action=\"#\" method=\"post\">
            <label for=\"name\">Nom :</label>
            <input id=\"name\" name=\"name\" placeholder=\"Nom\" type=\"text\"/>
            <label for=\"email\">E-mail :</label>
            <input id=\"email\" name=\"email\" placeholder=\"Email\" type=\"email\"/>
            <label for=\"subject\">Sujet :</label>
            <input id=\"subject\" name=\"subject\" placeholder=\"Sujet\" type=\"text\"/>
            <label for=\"message\">Message :</label>
            <textarea id=\"message\" name=\"message\" placeholder=\"Message\" rows=\"9\"></textarea>
            <input class=\"button\" type=\"submit\" value=\"Envoyer !\"/>
        </form>
    </section>
";
    }

    public function getTemplateName()
    {
        return "Front/contact.html.twig";
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
        return new Source("", "Front/contact.html.twig", "/var/www/blog/View/Front/contact.html.twig");
    }
}
