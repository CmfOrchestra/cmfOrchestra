<?php

/* PiAppTemplateBundle::Template\Layout\layout-global.html.twig */
class __TwigTemplate_ff6b92452a13a0740aaead20c47450a2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'global_title' => array($this, 'block_global_title'),
            'global_meta' => array($this, 'block_global_meta'),
            'global_script_divers' => array($this, 'block_global_script_divers'),
            'global_script_js' => array($this, 'block_global_script_js'),
            'global_script_css' => array($this, 'block_global_script_css'),
            'global_layout' => array($this, 'block_global_layout'),
            'global_flashes' => array($this, 'block_global_flashes'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["__internal_3a30c9cdbcf721db248a0311d3b202f615bf46b8"] = $this->env->loadTemplate($this->env->getExtension('admin_service_extension')->getParameterFunction("pi_app_admin.layout.template.flash"));
        // line 2
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            // line 3
            echo "\t";
            echo $this->env->getExtension('admin_jquery_extension')->initJquery("SESSION:flash");
            // line 4
            echo "\t";
            echo $this->env->getExtension('admin_jquery_extension')->initJquery("MENU:org-chart-page");
            // line 5
            echo "\t";
            echo $this->env->getExtension('admin_jquery_extension')->initJquery("MENU:context-menu");
            // line 6
            echo "\t";
            echo $this->env->getExtension('admin_jquery_extension')->initJquery("TOOL:widgetadmin");
            // line 7
            echo "\t";
            echo $this->env->getExtension('admin_jquery_extension')->initJquery("TOOL:veneer");
        }
        // line 9
        if ((!array_key_exists("global_local_language", $context))) {
            // line 10
            echo " \t";
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            $context["global_local_language"] = twig_lower_filter($this->env, $this->getAttribute($this->getAttribute($_app_, "session"), "getLocale", array(), "method"));
        }
        // line 12
        echo "<!DOCTYPE html>
<html lang='";
        // line 13
        if (isset($context["global_local_language"])) { $_global_local_language_ = $context["global_local_language"]; } else { $_global_local_language_ = null; }
        echo twig_escape_filter($this->env, $_global_local_language_, "html", null, true);
        echo "' xml:lang='";
        if (isset($context["global_local_language"])) { $_global_local_language_ = $context["global_local_language"]; } else { $_global_local_language_ = null; }
        echo twig_escape_filter($this->env, $_global_local_language_, "html", null, true);
        echo "' >
    <head>
        <title>";
        // line 15
        $this->displayBlock('global_title', $context, $blocks);
        echo "</title>
        <link rel=\"shortcut icon\" type=\"image/ico\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
        
        <!--  Meta core -->
        ";
        // line 19
        $this->displayBlock('global_meta', $context, $blocks);
        echo "          
        
        <!--  Css core -->
        ";
        // line 22
        echo $this->env->getExtension('pi_app_admin')->addCssFile("bundles/piappadmin/css/layout/screen-layout-global.css:prepend");
        // line 23
        echo "        ";
        echo $this->env->getExtension('pi_app_admin')->renderLink();
        echo "  
        
        <!--[if lt IE 9]>
\t\t\t<script type=\"text/javascript\"src=\"/bundles/piappadmin/js/html5shiv/html5shiv.js\"></script>
\t\t\t<script type=\"text/javascript\"src=\"/bundles/piappadmin/js/html5shiv/html5shiv-printshiv.js\"></script>
\t\t<![endif]-->        
        
        <!--  Js core -->
\t\t";
        // line 31
        echo $this->env->getExtension('pi_app_admin')->addJsFile("bundles/piappadmin/js/ui/jquery-ui-1.8.18.custom.min.js");
        // line 32
        echo "\t\t";
        echo $this->env->getExtension('pi_app_admin')->addJsFile("bundles/piappadmin/js/jquery/jquery-1.7.1.min.js");
        echo "   
\t\t";
        // line 33
        echo $this->env->getExtension('pi_app_admin')->renderScript();
        echo "     
        
        <!--  script divers -->
        ";
        // line 36
        $this->displayBlock('global_script_divers', $context, $blocks);
        // line 62
        echo "                
        
        <!--  script Js core -->
        ";
        // line 65
        $this->displayBlock('global_script_js', $context, $blocks);
        echo "        
        
        <!--  script Css core -->
        ";
        // line 68
        $this->displayBlock('global_script_css', $context, $blocks);
        // line 69
        echo "        
    </head>
    <body>
    
    \t<div id=\"global-layout\" >
    \t\t";
        // line 74
        $this->displayBlock('global_layout', $context, $blocks);
        // line 75
        echo "    \t\t
\t\t\t<script type=\"text/javascript\">
\t\t\t//<![CDATA[\t\t\t
\t\t\t\t// exemple definition of picture : <img src=\"#\" delayedsrc=\"http://mydomain.com/myimage.png\"/ >
\t\t\t\tjQuery(document).ready(function() {
\t\t\t\t\t\$('img').each(function(){
\t\t\t\t\t  \t\$(this).attr('src', \$(this).attr('delayedsrc'));
\t\t\t\t\t});
\t\t\t\t});
\t\t\t//]]>
\t\t\t</script>    \t\t
\t    </div>
\t     
\t\t";
        // line 88
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            // line 89
            echo "\t\t<searchlucene>\t\t\t
\t\t\t    <div id=\"global-flash\">
\t\t\t\t\t";
            // line 91
            $this->displayBlock('global_flashes', $context, $blocks);
            // line 97
            echo "\t\t\t\t</div>\t\t
\t\t\t
\t\t\t\t<div id=\"pi_page_bar_toggler\"  class=\"menu-xp org-chart-page\" ></div>
\t\t\t\t<div id=\"pi_media_bar_toggler\" class=\"menu-xp org-tree-page\" ></div>\t
\t\t\t\t\t\t\t\t\t
\t\t\t\t";
            // line 102
            $context["theme"] = $this->env->getExtension('admin_service_extension')->getParameterFunction("pi_app_admin.admin.context_menu_theme");
            // line 103
            echo "\t\t\t\t";
            if (isset($context["theme"])) { $_theme_ = $context["theme"]; } else { $_theme_ = null; }
            $context["options_contextmenu"] = array("id" => ".menu-xp", "theme" => $_theme_, "menu" => "admin", "options" => array("shadow" => "true", "shadowOpacity" => ".4", "shadowColor" => "#000", "shadowOffset" => "13", "shadowWidthAdjust" => "-3", "shadowHeightAdjust" => "-3"));
            // line 111
            echo "\t\t\t\t";
            if (isset($context["options_contextmenu"])) { $_options_contextmenu_ = $context["options_contextmenu"]; } else { $_options_contextmenu_ = null; }
            echo $this->env->getExtension('admin_jquery_extension')->FactoryFunction("MENU", "context-menu", $_options_contextmenu_);
            echo "\t\t\t
\t\t\t\t
\t\t\t\t";
            // line 113
            $context["options_chartpage"] = array("action" => "renderByClick", "id" => ".org-chart-page", "menu" => "page");
            echo " 
\t \t\t\t";
            // line 114
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            if (isset($context["options_chartpage"])) { $_options_chartpage_ = $context["options_chartpage"]; } else { $_options_chartpage_ = null; }
            echo $this->getAttribute($this->env->getExtension('admin_service_extension')->getServiceFunction("pi_app_admin.manager.tree"), "run", array(0 => "organigram", 1 => "Rubrique~org-chart-page", 2 => $this->getAttribute($this->getAttribute($_app_, "session"), "getLocale", array(), "method"), 3 => $_options_chartpage_), "method");
            echo "
\t \t\t\t
\t\t\t\t";
            // line 116
            echo $this->env->getExtension('admin_jquery_extension')->FactoryFunction("TOOL", "widgetadmin");
            echo "
\t\t\t\t
\t\t\t\t";
            // line 118
            $context["options_veneer"] = array("id" => ".veneer_blocks_widgets");
            // line 119
            echo "\t\t\t\t";
            if (isset($context["options_veneer"])) { $_options_veneer_ = $context["options_veneer"]; } else { $_options_veneer_ = null; }
            echo $this->env->getExtension('admin_jquery_extension')->FactoryFunction("TOOL", "veneer", $_options_veneer_);
            echo "
\t\t</searchlucene>\t\t\t\t
\t\t";
        }
        // line 121
        echo "\t\t
\t\t
\t\t";
        // line 123
        $context["is_google_analytic"] = $this->env->getExtension('admin_service_extension')->getParameterFunction("pi_app_admin.page.google_analytic");
        // line 124
        echo "\t\t";
        if (isset($context["is_google_analytic"])) { $_is_google_analytic_ = $context["is_google_analytic"]; } else { $_is_google_analytic_ = null; }
        if ($_is_google_analytic_) {
            // line 125
            echo "\t\t\t";
            $context["tracker"] = $this->env->getExtension('admin_service_extension')->getParameterFunction("pi_app_admin.page.google_analytic_tracker");
            // line 126
            echo "\t\t\t";
            $context["template"] = $this->env->getExtension('admin_service_extension')->getParameterFunction("pi_app_admin.page.google_analytic_template");
            // line 127
            echo "\t\t\t";
            if (isset($context["template"])) { $_template_ = $context["template"]; } else { $_template_ = null; }
            if (isset($context["tracker"])) { $_tracker_ = $context["tracker"]; } else { $_tracker_ = null; }
            $template = $this->env->resolveTemplate($_template_);
            $template->display(array_merge($context, array("trackerKey" => $_tracker_)));
            // line 128
            echo "\t\t";
        }
        // line 129
        echo "\t\t\t\t\t\t     
    </body>
</html>";
    }

    // line 15
    public function block_global_title($context, array $blocks = array())
    {
    }

    // line 19
    public function block_global_meta($context, array $blocks = array())
    {
    }

    // line 36
    public function block_global_script_divers($context, array $blocks = array())
    {
        // line 37
        echo "        
\t        ";
        // line 38
        if ((!$this->env->getExtension('security')->isGranted("ROLE_USER"))) {
            echo "\t        
\t        ";
            // line 60
            echo "\t\t\t";
        }
        echo "\t\t\t
        
        ";
    }

    // line 65
    public function block_global_script_js($context, array $blocks = array())
    {
    }

    // line 68
    public function block_global_script_css($context, array $blocks = array())
    {
    }

    // line 74
    public function block_global_layout($context, array $blocks = array())
    {
    }

    // line 91
    public function block_global_flashes($context, array $blocks = array())
    {
        // line 92
        echo "\t\t\t\t\t    ";
        echo $context["__internal_3a30c9cdbcf721db248a0311d3b202f615bf46b8"]->getsession_flash();
        echo "
\t\t\t\t\t    
\t\t\t\t\t\t";
        // line 94
        $context["options_flash"] = array("type" => array(0 => "notice", 1 => "success", 2 => "warning"), "dialog-name" => "symfony-layout-flash");
        // line 95
        echo "\t\t\t\t\t\t";
        if (isset($context["options_flash"])) { $_options_flash_ = $context["options_flash"]; } else { $_options_flash_ = null; }
        echo $this->env->getExtension('admin_jquery_extension')->FactoryFunction("SESSION", "flash", $_options_flash_);
        echo " \t    
\t\t\t\t\t";
    }

    public function getTemplateName()
    {
        return "PiAppTemplateBundle::Template\\Layout\\layout-global.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  284 => 95,  282 => 94,  276 => 92,  273 => 91,  268 => 74,  263 => 68,  258 => 65,  250 => 60,  246 => 38,  243 => 37,  240 => 36,  235 => 19,  230 => 15,  224 => 129,  221 => 128,  215 => 127,  212 => 126,  209 => 125,  205 => 124,  203 => 123,  199 => 121,  191 => 119,  189 => 118,  184 => 116,  177 => 114,  173 => 113,  166 => 111,  162 => 103,  160 => 102,  151 => 91,  147 => 89,  145 => 88,  130 => 75,  128 => 74,  121 => 69,  119 => 68,  113 => 65,  108 => 62,  106 => 36,  100 => 33,  95 => 32,  81 => 23,  79 => 22,  63 => 15,  54 => 13,  51 => 12,  46 => 10,  40 => 7,  37 => 6,  34 => 5,  31 => 4,  28 => 3,  26 => 2,  153 => 97,  141 => 84,  138 => 83,  136 => 82,  129 => 78,  78 => 32,  73 => 19,  70 => 28,  47 => 9,  44 => 9,  98 => 30,  93 => 31,  82 => 22,  77 => 21,  71 => 19,  67 => 16,  62 => 17,  56 => 13,  50 => 12,  45 => 15,  42 => 9,  38 => 6,  35 => 6,  32 => 4,  27 => 1,  24 => 1,);
    }
}
