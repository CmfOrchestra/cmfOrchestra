<?php

/* PiAppAdminBundle:PageByTrans:edit_ajax.html.twig */
class __TwigTemplate_8ae26bfc0498fb8647b19e600b0db75d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("PiAppTemplateBundle::Template\\Layout\\layout-ajax.html.twig");

        $this->blocks = array(
            'global_layout' => array($this, 'block_global_layout'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "PiAppTemplateBundle::Template\\Layout\\layout-ajax.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo $this->env->getExtension('admin_jquery_extension')->initJquery("FORM:prototype-bytab");
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_global_layout($context, array $blocks = array())
    {
        // line 5
        echo "
\t";
        // line 6
        if (isset($context["edit_form"])) { $_edit_form_ = $context["edit_form"]; } else { $_edit_form_ = null; }
        if (isset($context["delete_form"])) { $_delete_form_ = $context["delete_form"]; } else { $_delete_form_ = null; }
        if (isset($context["NoLayout"])) { $_NoLayout_ = $context["NoLayout"]; } else { $_NoLayout_ = null; }
        if (isset($context["entity"])) { $_entity_ = $context["entity"]; } else { $_entity_ = null; }
        $this->env->loadTemplate("PiAppAdminBundle:PageByTrans:edit_view.html.twig")->display(array_merge($context, array("edit_form" => $_edit_form_, "delete_form" => $_delete_form_, "NoLayout" => $_NoLayout_, "entity" => $_entity_)));
        // line 7
        echo "
";
    }

    public function getTemplateName()
    {
        return "PiAppAdminBundle:PageByTrans:edit_ajax.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 7,  34 => 6,  31 => 5,  28 => 4,  23 => 1,);
    }
}
