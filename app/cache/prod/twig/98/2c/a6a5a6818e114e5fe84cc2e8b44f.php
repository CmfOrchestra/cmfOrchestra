<?php

/* PiAppTemplateBundle::Template\Layout\layout-ajax.html.twig */
class __TwigTemplate_982ca6a5a6818e114e5fe84cc2e8b44f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'global_title' => array($this, 'block_global_title'),
            'global_meta' => array($this, 'block_global_meta'),
            'global_script_js' => array($this, 'block_global_script_js'),
            'global_script_css' => array($this, 'block_global_script_css'),
            'global_script_divers' => array($this, 'block_global_script_divers'),
            'global_layout' => array($this, 'block_global_layout'),
            'content' => array($this, 'block_content'),
            'global_flashes' => array($this, 'block_global_flashes'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["__internal_ed99724b8c7a98a82ca8af5912743fce5c6e631e"] = $this->env->loadTemplate($this->env->getExtension('admin_service_extension')->getParameterFunction("pi_app_admin.layout.template.flash"));
        // line 2
        echo $this->env->getExtension('admin_jquery_extension')->initJquery("SESSION:flash");
        // line 3
        echo $this->env->getExtension('admin_jquery_extension')->initJquery("TOOL:languagechoice");
        // line 4
        echo "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
    <head>
        <title>";
        // line 8
        $this->displayBlock('global_title', $context, $blocks);
        echo "</title>
        
        <!--  Meta core -->
        ";
        // line 11
        $this->displayBlock('global_meta', $context, $blocks);
        echo "       
         
        
        <!--  Css core -->
        ";
        // line 15
        echo $this->env->getExtension('pi_app_admin')->addCssFile("bundles/piappadmin/css/layout/screen-layout-ajax.css:prepend");
        // line 16
        echo "        ";
        echo $this->env->getExtension('pi_app_admin')->renderLink();
        // line 17
        echo "        
        
        <!--  Js core -->
\t\t";
        // line 20
        echo $this->env->getExtension('pi_app_admin')->addJsFile("bundles/piappadmin/js/ui/jquery-ui-1.8.18.custom.min.js");
        // line 21
        echo "\t\t";
        echo $this->env->getExtension('pi_app_admin')->addJsFile("bundles/piappadmin/js/jquery/jquery-1.7.1.min.js");
        // line 22
        echo "        ";
        echo $this->env->getExtension('pi_app_admin')->renderScript();
        // line 23
        echo "        
        
        <!--  script Js core -->
        ";
        // line 26
        $this->displayBlock('global_script_js', $context, $blocks);
        // line 27
        echo "        
        
        <!--  script Css core -->
        ";
        // line 30
        $this->displayBlock('global_script_css', $context, $blocks);
        // line 31
        echo "        
        <!--  script divers -->
        ";
        // line 33
        $this->displayBlock('global_script_divers', $context, $blocks);
        // line 34
        echo "        
    </head>
    <body>
    
    \t<div id=\"global_layout\">
    \t
    \t\t";
        // line 40
        $context["options_languagechoice"] = array("class" => "ajax-language-choice", "img-arrow" => "lang_arrow_blue.png");
        // line 41
        echo "\t\t\t";
        if (isset($context["options_languagechoice"])) { $_options_languagechoice_ = $context["options_languagechoice"]; } else { $_options_languagechoice_ = null; }
        echo $this->env->getExtension('admin_jquery_extension')->FactoryFunction("TOOL", "languagechoice", $_options_languagechoice_);
        echo "
\t\t\t
\t\t\t<script type=\"text/javascript\">
\t\t\t//<![CDATA[
\t\t\t\tjQuery(document).ready(function() {
\t\t\t\t\t\$(\".ajax-language-choice\").draggable();
\t\t\t\t});
\t\t\t//]]>
\t\t\t</script>
\t\t\t\t
    \t\t";
        // line 51
        $this->displayBlock('global_layout', $context, $blocks);
        // line 52
        echo "    \t\t";
        $this->displayBlock('content', $context, $blocks);
        // line 53
        echo "    \t\t
\t    </div>
\t    <div id=\"global_layout-flexcroll-vscroller\"><div class=\"flexcroll-scrollbar\"></div></div>
\t    
\t\t";
        // line 57
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            // line 58
            echo "\t\t    <div id=\"global-flash\">
\t\t\t\t";
            // line 59
            $this->displayBlock('global_flashes', $context, $blocks);
            // line 65
            echo "\t\t\t</div>
\t\t";
        }
        // line 66
        echo "   
\t\t\t\t     
    </body>
</html>";
    }

    // line 8
    public function block_global_title($context, array $blocks = array())
    {
    }

    // line 11
    public function block_global_meta($context, array $blocks = array())
    {
    }

    // line 26
    public function block_global_script_js($context, array $blocks = array())
    {
    }

    // line 30
    public function block_global_script_css($context, array $blocks = array())
    {
    }

    // line 33
    public function block_global_script_divers($context, array $blocks = array())
    {
    }

    // line 51
    public function block_global_layout($context, array $blocks = array())
    {
    }

    // line 52
    public function block_content($context, array $blocks = array())
    {
    }

    // line 59
    public function block_global_flashes($context, array $blocks = array())
    {
        // line 60
        echo "\t\t\t\t    ";
        echo $context["__internal_ed99724b8c7a98a82ca8af5912743fce5c6e631e"]->getsession_flash();
        echo "
\t\t\t\t    
\t\t\t\t\t";
        // line 62
        $context["options_flash"] = array("type" => array(0 => "notice", 1 => "success", 2 => "warning"), "dialog-name" => "symfony-layout-flash");
        // line 63
        echo "\t\t\t\t\t";
        if (isset($context["options_flash"])) { $_options_flash_ = $context["options_flash"]; } else { $_options_flash_ = null; }
        echo $this->env->getExtension('admin_jquery_extension')->FactoryFunction("SESSION", "flash", $_options_flash_);
        echo " \t    
\t\t\t\t";
    }

    public function getTemplateName()
    {
        return "PiAppTemplateBundle::Template\\Layout\\layout-ajax.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  188 => 63,  186 => 62,  180 => 60,  177 => 59,  172 => 52,  167 => 51,  162 => 33,  157 => 30,  152 => 26,  147 => 11,  142 => 8,  135 => 66,  131 => 65,  129 => 59,  126 => 58,  124 => 57,  118 => 53,  115 => 52,  113 => 51,  98 => 41,  96 => 40,  88 => 34,  86 => 33,  82 => 31,  80 => 30,  75 => 27,  73 => 26,  68 => 23,  65 => 22,  62 => 21,  60 => 20,  55 => 17,  52 => 16,  50 => 15,  43 => 11,  37 => 8,  29 => 3,  27 => 2,  25 => 1,  40 => 7,  34 => 6,  31 => 4,  28 => 4,  23 => 1,);
    }
}
