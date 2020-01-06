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

/* Front/home.html.twig */
class __TwigTemplate_53fb2ee3024b1ce27625b56dc09fd393ff1b74915fae4e3f092b74f1b65a60a2 extends Template
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
        $this->parent = $this->loadTemplate("Front/template.html.twig", "Front/home.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Accueil";
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "    <section id=\"about\">
        <img alt=\"Eloïse RUIZ-RODRIGUEZ\" src=\"../../Public/images/profile.png\">
        <article>
            <h1>Eloïse RUIZ-RODRIGUEZ</h1>
            <h2>Développeur / Intégrateur Web</h2>
            <p>
                Passionnée par le milieu informatique et plus particulièrement par le développement web,
                j’ai entrepris une formation de<br>
                « Développeur d'application PHP/Symfony », en collaboration avec
                <a href=\"https://openclassrooms.com\" target=\"_blank\">OpenClassrooms.</a><br>
                Aujourd'hui je vous présente mon blog professionnel, qui je l'éspère sera à votre goût.<br>
            </p>
        </article>
    </section>
    <!-- CV -->
    <section id=\"cv\">
        <h3>Télécharger mon CV :</h3>
        <div>
            <a href=\"../../Public/docs/CV_Eloïse_RUIZ-RODRIGUEZ.pdf\" target=\"_blank\">
                Télécharger mon CV</a>
        </div>
    </section>
    <!-- Social -->
    <section id=\"social\">
        <h3>Suivez-moi :</h3>
        <div>
            <a href=\"https://www.linkedin.com/in/eloïse-ruiz-rodriguez\" target=\"_blank\">
                <img alt=\"icone linkedin\" src=\"../../Public/images/ico_in.png\"></a>
            <a href=\"https://github.com/Loly-webdev\" target=\"_blank\">
                <img alt=\"icone github\" src=\"../../Public/images/ico_git.png\"></a>
        </div>
    </section>
";
    }

    public function getTemplateName()
    {
        return "Front/home.html.twig";
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
        return new Source("", "Front/home.html.twig", "/var/www/blog/View/Front/home.html.twig");
    }
}
