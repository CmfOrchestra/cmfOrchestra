<?php

/* PiAppTemplateBundle::Template\Layout\Connexion\connexion.html.twig */
class __TwigTemplate_366bf749a2ec3f9dcd02e446b241363f extends Twig_Template
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
        echo "\t\t\t";
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 2
            echo "
\t\t\t\t<div class=\"nav-divider\">&nbsp;</div>
\t\t\t\t";
            // line 4
            $context["options_languagechoice"] = array("class" => "language-choice", "img-arrow" => "lang_arrow_blue.png");
            // line 5
            echo "\t\t\t\t";
            if (isset($context["options_languagechoice"])) { $_options_languagechoice_ = $context["options_languagechoice"]; } else { $_options_languagechoice_ = null; }
            echo $this->env->getExtension('admin_jquery_extension')->FactoryFunction("TOOL", "languagechoice", $_options_languagechoice_);
            echo "\t\t\t\t\t

\t\t\t\t<div class=\"nav-divider\">&nbsp;</div>
\t\t\t\t<div class=\"showhide-account\"><img src=\"";
            // line 8
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/images/shared/nav/nav_myaccount.gif"), "html", null, true);
            echo "\" width=\"93\" height=\"14\" alt=\"\" /></div>
\t\t\t\t
\t\t\t\t<div class=\"nav-divider\">&nbsp;</div>
\t\t\t\t<a href=\"";
            // line 11
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_security_logout"), "html", null, true);
            echo "\" id=\"logout\" title=\"\">
\t\t\t\t\t<img src=\"";
            // line 12
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/images/shared/nav/nav_logout.gif"), "html", null, true);
            echo "\" width=\"64\" height=\"14\" alt=\"\" />
\t\t\t\t</a>
\t\t\t\t<div class=\"clear\">&nbsp;</div>

\t\t\t\t<!--  start account-content -->\t
\t\t\t\t<div class=\"account-content\">
\t\t\t\t<div class=\"account-drop-inner\">
\t\t\t\t\t<a href=\"\" >";
            // line 19
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.logged_in_as", array("%username%" => $this->getAttribute($this->getAttribute($_app_, "user"), "username")), "FOSUserBundle"), "html", null, true);
            echo "</a>
\t\t\t\t\t<div class=\"clear\">&nbsp;</div>
\t\t\t\t\t<div class=\"acc-line\">&nbsp;</div>
\t\t\t\t\t<a href=\"\" id=\"acc-settings\">Settings</a>
\t\t\t\t\t<div class=\"clear\">&nbsp;</div>
\t\t\t\t\t<div class=\"acc-line\">&nbsp;</div>
\t\t\t\t\t<a href=\"";
            // line 25
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_profile_show"), "html", null, true);
            echo "\" id=\"acc-details\">Personal details </a>
\t\t\t\t\t<div class=\"clear\">&nbsp;</div>
\t\t\t\t\t<div class=\"acc-line\">&nbsp;</div>
\t\t\t\t\t<a href=\"\" id=\"acc-project\">Project details</a>
\t\t\t\t\t<div class=\"clear\">&nbsp;</div>
\t\t\t\t\t<div class=\"acc-line\">&nbsp;</div>
\t\t\t\t\t<a href=\"\" id=\"acc-inbox\">Inbox</a>
\t\t\t\t\t<div class=\"clear\">&nbsp;</div>
\t\t\t\t\t<div class=\"acc-line\">&nbsp;</div>
\t\t\t\t\t<a href=\"\" id=\"acc-stats\">Statistics</a> 
\t\t\t\t\t<div class=\"clear\">&nbsp;</div>
\t\t\t\t\t<div class=\"acc-line\">&nbsp;</div>
\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<!--  end account-content -->

\t\t\t";
        } else {
            // line 42
            echo "\t\t\t\t<div class=\"nav-divider\">&nbsp;</div>
\t\t\t\t<div class=\"showhide-account\">
\t\t\t\t\t<a href=\"";
            // line 44
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_registration_register"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.register", array(), "FOSUserBundle"), "html", null, true);
            echo "</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"nav-divider\">&nbsp;</div>
\t\t\t\t<a href=\"";
            // line 47
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_security_login"), "html", null, true);
            echo "\" id=\"logout\" title=\"\">
\t\t\t\t\t";
            // line 48
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.login", array(), "FOSUserBundle"), "html", null, true);
            echo "
\t\t\t\t</a>
\t\t\t\t<div class=\"clear\">&nbsp;</div>
\t\t\t";
        }
        // line 51
        echo "\t";
    }

    public function getTemplateName()
    {
        return "PiAppTemplateBundle::Template\\Layout\\Connexion\\connexion.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  107 => 51,  100 => 48,  96 => 47,  88 => 44,  64 => 25,  44 => 12,  40 => 11,  34 => 8,  26 => 5,  24 => 4,  20 => 2,  17 => 1,  526 => 238,  523 => 237,  509 => 271,  503 => 270,  469 => 238,  467 => 237,  454 => 227,  447 => 223,  438 => 217,  402 => 188,  394 => 187,  386 => 186,  378 => 185,  369 => 183,  361 => 182,  353 => 181,  344 => 179,  339 => 177,  332 => 175,  316 => 166,  308 => 165,  300 => 164,  292 => 163,  287 => 161,  280 => 159,  264 => 150,  256 => 149,  248 => 148,  243 => 146,  236 => 144,  232 => 142,  218 => 134,  211 => 132,  205 => 131,  199 => 130,  193 => 129,  186 => 127,  180 => 126,  170 => 122,  168 => 121,  158 => 113,  156 => 112,  138 => 96,  129 => 65,  115 => 55,  112 => 54,  98 => 42,  84 => 42,  71 => 21,  65 => 18,  59 => 16,  56 => 15,  43 => 9,  37 => 7,  31 => 5,  29 => 2,  27 => 1,  54 => 19,  49 => 11,  46 => 10,  42 => 8,  39 => 7,  36 => 6,  28 => 4,  22 => 1,);
    }
}
