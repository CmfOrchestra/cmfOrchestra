<?php

/* BootStrapUserBundle::connexion.html.twig */
class __TwigTemplate_c7cea4ce03213c8e7ca1955f1bcbf7c7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div>
";
        // line 2
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 3
            echo "    <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_profile_show"), "html", null, true);
            echo "\" title=\"\">";
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.logged_in_as", array("%username%" => $this->getAttribute($this->getAttribute($_app_, "user"), "username")), "FOSUserBundle"), "html", null, true);
            echo "</a> |
    <a href=\"";
            // line 4
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_security_logout"), "html", null, true);
            echo "\" title=\"\">
        ";
            // line 5
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.logout", array(), "FOSUserBundle"), "html", null, true);
            echo "
    </a>
";
        } else {
            // line 8
            echo "    <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_security_login"), "html", null, true);
            echo "\" title=\"\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.login", array(), "FOSUserBundle"), "html", null, true);
            echo "</a> |
    <a href=\"";
            // line 9
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_registration_register"), "html", null, true);
            echo "\" title=\"\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.register", array(), "FOSUserBundle"), "html", null, true);
            echo "</a>
";
        }
        // line 11
        echo "</div>

";
        // line 13
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($_app_, "session"), "getFlashes", array(), "method"));
        foreach ($context['_seq'] as $context["key"] => $context["flash"]) {
            // line 14
            echo "<div class=\"";
            if (isset($context["flash"])) { $_flash_ = $context["flash"]; } else { $_flash_ = null; }
            echo twig_escape_filter($this->env, $_flash_, "html", null, true);
            echo "\">
    ";
            // line 15
            if (isset($context["key"])) { $_key_ = $context["key"]; } else { $_key_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($_key_, array(), "FOSUserBundle"), "html", null, true);
            echo "
</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['flash'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
    }

    public function getTemplateName()
    {
        return "BootStrapUserBundle::connexion.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 15,  58 => 13,  30 => 4,  20 => 2,  149 => 31,  140 => 29,  132 => 27,  127 => 26,  110 => 22,  107 => 21,  104 => 20,  101 => 19,  96 => 18,  92 => 17,  89 => 16,  61 => 10,  57 => 8,  22 => 3,  17 => 1,  284 => 95,  282 => 94,  276 => 92,  273 => 91,  268 => 74,  263 => 68,  258 => 65,  250 => 60,  246 => 38,  243 => 37,  240 => 36,  235 => 19,  230 => 15,  224 => 129,  221 => 128,  215 => 127,  212 => 126,  209 => 125,  205 => 124,  203 => 123,  199 => 121,  191 => 119,  189 => 118,  184 => 116,  177 => 114,  173 => 113,  166 => 111,  162 => 103,  160 => 102,  151 => 91,  147 => 89,  145 => 88,  130 => 75,  128 => 74,  121 => 25,  119 => 68,  113 => 23,  108 => 62,  106 => 36,  100 => 33,  95 => 32,  81 => 23,  79 => 22,  63 => 14,  54 => 11,  51 => 6,  46 => 10,  40 => 8,  37 => 6,  34 => 5,  31 => 4,  28 => 3,  26 => 2,  153 => 33,  141 => 84,  138 => 83,  136 => 82,  129 => 78,  78 => 15,  73 => 19,  70 => 28,  47 => 9,  44 => 3,  98 => 30,  93 => 31,  82 => 22,  77 => 21,  71 => 19,  67 => 16,  62 => 17,  56 => 13,  50 => 12,  45 => 15,  42 => 9,  38 => 6,  35 => 2,  32 => 4,  27 => 1,  24 => 1,);
    }
}
