<?php

/* PiAppAdminBundle:Frontend:index.html.twig */
class __TwigTemplate_f8a12c315ede0585e68423e7f3ba9656 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate($this->getContext($context, "layout_nav"));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        $context["layout_nav"] = $this->getAttribute($this->getAttribute($_app_, "session"), "get", array(0 => "wurfl-layout"), "method");
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        echo " ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.welcome.title"), "html", null, true);
        echo " ";
    }

    // line 6
    public function block_content($context, array $blocks = array())
    {
        // line 7
        echo "    ";
        $context["is_google_analytic"] = $this->env->getExtension('admin_service_extension')->getParameterFunction("pi_app_admin.page.google_analytic");
        // line 8
        echo "    ";
        if (isset($context["is_google_analytic"])) { $_is_google_analytic_ = $context["is_google_analytic"]; } else { $_is_google_analytic_ = null; }
        if ($_is_google_analytic_) {
            // line 9
            echo "        ";
            $context["template"] = $this->env->getExtension('admin_service_extension')->getParameterFunction("pi_app_admin.page.google_analytic_template2");
            // line 10
            echo "        ";
            if (isset($context["template"])) { $_template_ = $context["template"]; } else { $_template_ = null; }
            $template = $this->env->resolveTemplate($_template_);
            $template->display($context);
            // line 11
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "PiAppAdminBundle:Frontend:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 11,  49 => 10,  46 => 9,  42 => 8,  39 => 7,  36 => 6,  28 => 4,  22 => 1,);
    }
}
