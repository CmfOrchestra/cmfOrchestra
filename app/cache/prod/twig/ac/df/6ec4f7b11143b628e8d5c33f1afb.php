<?php

/* PiAppTemplateBundle::Template\Layout\Connexion\layout-security.html.twig */
class __TwigTemplate_acdf6ec4f7b11143b628e8d5c33f1afb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
\t<title>Orchestra</title>
\t<link rel=\"shortcut icon\" type=\"image/ico\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
\t<link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/css/layout/admin/screen.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"screen\" title=\"default\" />
\t<!--  jquery core -->
\t<script src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/js/jquery/jquery-1.7.1.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
\t
\t<!-- Custom jquery scripts -->
\t<script src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/js/jquery/custom_jquery.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
\t
\t<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
\t<script src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/js/jquery/jquery.pngFix.pack.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
\t<script type=\"text/javascript\">
\t//<![CDATA[
\t\$(document).ready(function(){
\t\$(document).pngFix( );
\t});
\t//]]>
\t</script>
</head>
<body id=\"login-bg\"> 
 
<!-- Start: login-holder -->
<div id=\"login-holder\">

\t<!-- start logo -->
\t<div id=\"logo-login\">
\t\t<a href=\"index.html\" title=\"login page\"><img src=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/images/logo/logo-orchestra-white.png"), "html", null, true);
        echo "\" width=\"212\" height=\"70\" alt=\"\" /></a>
\t</div>
\t<!-- end logo -->
\t
\t<div class=\"clear\"></div>
\t
\t<!--  start loginbox ................................................................................. -->
\t<div id=\"loginbox\">
\t
\t<!--  start login-inner -->
\t<div id=\"login-inner\">
\t\t";
        // line 42
        $this->displayBlock('content', $context, $blocks);
        // line 43
        echo "\t\t
\t</div>
 \t<!--  end login-inner -->
\t<div class=\"clear\"></div>
\t<a href=\"javascript:void(0);\" class=\"forgot-pwd\" title=\"forgot password\">Forgot Password?</a>
 </div>
 <!--  end loginbox -->
 
</div>
<!-- End: login-holder -->

\t<script type=\"text/javascript\">
\t//<![CDATA[
\t\t\$(document).ready(function() {
\t\t    var prototype\t= \$('form + p');
\t\t\tvar target \t\t= \$('.forgot-pwd');
\t\t\ttarget.html(prototype);

\t\t\t\$('#username').focus();
\t\t});
\t//]]>
\t</script> 
</body>
</html>";
    }

    // line 42
    public function block_content($context, array $blocks = array())
    {
        // line 43
        echo "\t    ";
    }

    public function getTemplateName()
    {
        return "PiAppTemplateBundle::Template\\Layout\\Connexion\\layout-security.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  111 => 43,  108 => 42,  81 => 43,  79 => 42,  65 => 31,  46 => 15,  34 => 9,  18 => 1,  43 => 12,  40 => 12,  35 => 9,  25 => 6,  23 => 1,  82 => 29,  74 => 24,  67 => 20,  59 => 15,  52 => 12,  48 => 11,  42 => 8,  39 => 7,  32 => 5,  29 => 7,  26 => 3,);
    }
}
