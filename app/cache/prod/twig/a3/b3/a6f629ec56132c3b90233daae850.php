<?php

/* FOSUserBundle:Security:login.html.twig */
class __TwigTemplate_a3b3a6f629ec56132c3b90233daae850 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("FOSUserBundle::layout.html.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "FOSUserBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
        if ($_error_) {
            // line 5
            echo "    <div>";
            if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
            echo twig_escape_filter($this->env, $_error_, "html", null, true);
            echo "</div>
";
        }
        // line 7
        echo "
<form action=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_security_check"), "html", null, true);
        echo "\" method=\"post\">
\t\t<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
\t\t<tr>
\t\t\t<th>";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.username", array(), "FOSUserBundle"), "html", null, true);
        echo "</th>
\t\t\t<td><input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 12
        if (isset($context["last_username"])) { $_last_username_ = $context["last_username"]; } else { $_last_username_ = null; }
        echo twig_escape_filter($this->env, $_last_username_, "html", null, true);
        echo "\"  class=\"login-inp\" /></td>
\t\t</tr>
\t\t<tr>
\t\t\t<th><label for=\"password\">";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.password", array(), "FOSUserBundle"), "html", null, true);
        echo "</label></th>
\t\t\t<td><input type=\"password\" id=\"password\" name=\"_password\" class=\"login-inp\" /></td>
\t\t</tr>
\t\t<tr>
\t\t\t<th></th>
\t\t\t<td valign=\"top\"><input type=\"checkbox\" id=\"login-check\" name=\"_login-check\" value=\"on\" class=\"checkbox-size\"  /><label for=\"login-check\">";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.remember_me", array(), "FOSUserBundle"), "html", null, true);
        echo "</label></td>
\t\t</tr>
\t\t<tr>
\t\t\t<th></th>
\t\t\t<td><input type=\"submit\" name=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "\" class=\"submit-login\" /></td>
\t\t</tr>
\t\t</table>
</form>
<p>
    <a href=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_resetting_request"), "html", null, true);
        echo "\" title=\"\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("resetting.request.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "</a>
</p>

";
    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Security:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 29,  74 => 24,  67 => 20,  59 => 15,  52 => 12,  48 => 11,  42 => 8,  39 => 7,  32 => 5,  29 => 4,  26 => 3,);
    }
}
