<?php

/* home.twig */
class __TwigTemplate_6118442f8f47a7d91cfd8cf0f75758b306618c942376b605d2900681fb14a28a extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "Welcome dear, ";
        echo twig_escape_filter($this->env, twig_var_dump($this->env, $context, ($context["user"] ?? null)), "html", null, true);
    }

    public function getTemplateName()
    {
        return "home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("Welcome dear, {{ dump(user) }}", "home.twig", "/home/mehran/www/framework/views/home.twig");
    }
}
