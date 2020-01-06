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

/* Front/listPosts.html.twig */
class __TwigTemplate_28bcd84e529537b32632fc6b494b684ce0b1b3e4446eb4600c859a8f8dffd6ce extends Template
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
            'postTitle' => [$this, 'block_postTitle'],
            'dateTitle' => [$this, 'block_dateTitle'],
            'postContent' => [$this, 'block_postContent'],
            'postComment' => [$this, 'block_postComment'],
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
        $this->parent = $this->loadTemplate("Front/template.html.twig", "Front/listPosts.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Blog";
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "
    <h2>Derniers billets du blog :</h2>

    ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["posts"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 10
            echo "        <div class=\"news\">
            <h3>
                ";
            // line 12
            $this->displayBlock('postTitle', $context, $blocks);
            // line 15
            echo "
                ";
            // line 16
            $this->displayBlock('dateTitle', $context, $blocks);
            // line 19
            echo "            </h3>
            <p>
                ";
            // line 21
            $this->displayBlock('postContent', $context, $blocks);
            // line 24
            echo "                <br/>
                ";
            // line 25
            $this->displayBlock('postComment', $context, $blocks);
            // line 28
            echo "            </p>
        </div>
    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "
";
    }

    // line 12
    public function block_postTitle($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 13
        echo "                    ";
        echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = ($context["post"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["title"] ?? null) : null), "html", null, true);
        echo "
                ";
    }

    // line 16
    public function block_dateTitle($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 17
        echo "                    <em>le ";
        echo twig_escape_filter($this->env, (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = ($context["post"] ?? null)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["creation_date_fr"] ?? null) : null), "html", null, true);
        echo "</em>
                ";
    }

    // line 21
    public function block_postContent($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 22
        echo "                    ";
        echo twig_escape_filter($this->env, (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = ($context["post"] ?? null)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["content"] ?? null) : null), "html", null, true);
        echo "
                ";
    }

    // line 25
    public function block_postComment($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 26
        echo "                    <em><a href=\"";
        echo twig_escape_filter($this->env, (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = ($context["post"] ?? null)) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["id"] ?? null) : null), "html", null, true);
        echo "\">Commentaires</a></em>
                ";
    }

    public function getTemplateName()
    {
        return "Front/listPosts.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  164 => 26,  160 => 25,  153 => 22,  149 => 21,  142 => 17,  138 => 16,  131 => 13,  127 => 12,  122 => 31,  106 => 28,  104 => 25,  101 => 24,  99 => 21,  95 => 19,  93 => 16,  90 => 15,  88 => 12,  84 => 10,  67 => 9,  62 => 6,  58 => 5,  51 => 3,  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "Front/listPosts.html.twig", "/var/www/blog/View/Front/listPosts.html.twig");
    }
}
