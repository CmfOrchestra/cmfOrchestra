<?php

/* page:1:fr_FR */
class __TwigTemplate_26d0c0ed1ddb2aac77c4b4d50b2a4606 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'global_title' => array($this, 'block_global_title'),
            'global_meta' => array($this, 'block_global_meta'),
            'global_script_js' => array($this, 'block_global_script_js'),
            'global_script_css' => array($this, 'block_global_script_css'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate($this->getContext($context, "layout_nav"));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        $context["layout_screen"] = $this->getAttribute($this->getAttribute($_app_, "session"), "get", array(0 => "wurfl-screen"), "method");
        // line 3
        $context["is_switch_layout_mobile_authorized"] = $this->env->getExtension('admin_service_extension')->getParameterFunction("pi_app_admin.page.switch_layout_mobile_authorized");
        if (isset($context["layout_screen"])) { $_layout_screen_ = $context["layout_screen"]; } else { $_layout_screen_ = null; }
        if (isset($context["is_switch_layout_mobile_authorized"])) { $_is_switch_layout_mobile_authorized_ = $context["is_switch_layout_mobile_authorized"]; } else { $_is_switch_layout_mobile_authorized_ = null; }
        if ((twig_test_empty($_layout_screen_) || (!$_is_switch_layout_mobile_authorized_))) {
            // line 4
            $context["layout_screen"] = "layout";
        }
        // line 6
        if (isset($context["layout_screen"])) { $_layout_screen_ = $context["layout_screen"]; } else { $_layout_screen_ = null; }
        if (twig_in_filter($_layout_screen_, array(0 => "layout-poor", 1 => "layout-medium", 2 => "layout-high", 3 => "layout-ultra"))) {
            // line 7
            if (isset($context["layout_screen"])) { $_layout_screen_ = $context["layout_screen"]; } else { $_layout_screen_ = null; }
            $context["layout_nav"] = (("PiAppTemplateBundle::Template\\Layout\\Mobile\\Default\\" . $_layout_screen_) . ".html.twig");
        } else {
            // line 9
            $context["layout_nav"] = "PiAppTemplateBundle::Template\\Layout\\Pc\\layout-pi-orchestra.html.twig";
        }
        // line 15
        $context["global_local_language"] = "fr_fr";
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 12
    public function block_global_title($context, array $blocks = array())
    {
        $this->displayParentBlock("global_title", $context, $blocks);
        echo " 
";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('admin_tool_extension')->getTitlePageFunction(""), "html", null, true);
        echo " 
";
    }

    // line 17
    public function block_global_meta($context, array $blocks = array())
    {
        echo " 
";
        // line 18
        $this->displayParentBlock("global_meta", $context, $blocks);
        echo "\t
\t";
        // line 19
        echo $this->env->getExtension('admin_tool_extension')->getMetaPageFunction(array("description" => "", "keywords" => "", "title" => ""));
        echo " 
";
    }

    // line 21
    public function block_global_script_js($context, array $blocks = array())
    {
        echo " 
 ";
        // line 22
        $this->displayParentBlock("global_script_js", $context, $blocks);
        echo " 
 <script type=\"text/javascript\"> 
 //<![CDATA[ 
 
 //]]> 
 </script> 
";
    }

    // line 29
    public function block_global_script_css($context, array $blocks = array())
    {
        echo " 
 ";
        // line 30
        $this->displayParentBlock("global_script_css", $context, $blocks);
        echo " 
 <style type=\"txt/css\"> 
<!-- 
 
 
--> 
</style> 
";
    }

    public function getTemplateName()
    {
        return "page:1:fr_FR";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  98 => 30,  93 => 29,  82 => 22,  77 => 21,  71 => 19,  67 => 18,  62 => 17,  56 => 13,  50 => 12,  45 => 15,  42 => 9,  38 => 7,  35 => 6,  32 => 4,  27 => 3,  24 => 2,  17 => 1,);
    }
}
