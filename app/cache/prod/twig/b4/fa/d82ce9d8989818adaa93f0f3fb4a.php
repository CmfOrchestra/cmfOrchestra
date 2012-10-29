<?php

/* FOSUserBundle::layout.html.twig */
class __TwigTemplate_b4fad82ce9d8989818adaa93f0f3fb4a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate($this->getContext($context, "layout_nav"));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if ($this->env->getExtension('security')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 2
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            $context["layout_nav"] = $this->getAttribute($this->getAttribute($_app_, "session"), "get", array(0 => "wurfl-layout"), "method");
        } else {
            // line 4
            $context["layout_nav"] = $this->env->getExtension('admin_service_extension')->getParameterFunction("pi_app_admin.layout.template.connexion");
        }
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 9
    public function block_title($context, array $blocks = array())
    {
    }

    // line 11
    public function block_content($context, array $blocks = array())
    {
        // line 12
        echo "    ";
        $this->displayBlock('fos_user_content', $context, $blocks);
    }

    public function block_fos_user_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "FOSUserBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 12,  40 => 11,  35 => 9,  25 => 2,  23 => 1,  82 => 29,  74 => 24,  67 => 20,  59 => 15,  52 => 12,  48 => 11,  42 => 8,  39 => 7,  32 => 5,  29 => 4,  26 => 3,);
    }
}
