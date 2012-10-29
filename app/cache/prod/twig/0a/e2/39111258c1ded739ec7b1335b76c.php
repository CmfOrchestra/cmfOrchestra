<?php

/* PiAppTemplateBundle::Template\Layout\Pc\layout-pi-orchestra.html.twig */
class __TwigTemplate_0ae239111258c1ded739ec7b1335b76c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("PiAppTemplateBundle::Template\\Layout\\layout-global.html.twig");

        $this->blocks = array(
            'global_title' => array($this, 'block_global_title'),
            'global_meta' => array($this, 'block_global_meta'),
            'global_script_divers' => array($this, 'block_global_script_divers'),
            'global_layout' => array($this, 'block_global_layout'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "PiAppTemplateBundle::Template\\Layout\\layout-global.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo $this->env->getExtension('pi_app_admin')->addCssFile("bundles/piappadmin/css/layout/pi/pi-orchestra.css");
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_global_title($context, array $blocks = array())
    {
        $this->displayParentBlock("global_title", $context, $blocks);
    }

    // line 6
    public function block_global_meta($context, array $blocks = array())
    {
        $this->displayParentBlock("global_meta", $context, $blocks);
    }

    // line 8
    public function block_global_script_divers($context, array $blocks = array())
    {
        // line 9
        echo "\t\t";
        $this->displayParentBlock("global_script_divers", $context, $blocks);
        echo "
\t\t
\t\t<script type=\"text/javascript\">
\t\t//<![CDATA[\t\t\t
\t\t\t\$(document).ready(function(){
\t\t\t\t\$(\".main-content\").animate({top:0},1500,function(){
\t\t\t\t\tMove();
\t\t\t\t});
\t\t\t});
\t\t\tfunction Move() {
\t\t\t   \$(\"#moving_arrow\").animate({top:\"45px\"},1000, function(){
\t\t\t\t\$(this).css({\"top\":\"0px\",\"display\":\"none\"}).fadeIn(2000);
\t\t\t   });
\t\t\t   setTimeout(\"Move()\",10000);
\t\t\t}           
\t\t//]]>
\t\t</script> 
";
    }

    // line 28
    public function block_global_layout($context, array $blocks = array())
    {
        // line 29
        echo "
    \t<div class=\"main-content\" >
\t\t\t<h1>Orchestra - Content Management Framework</h1>
\t\t\t<a href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("home_page"), "html", null, true);
        echo "\"><img class=\"logo\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/css/layout/pi/orchestra/logo.png"), "html", null, true);
        echo "\" title=\"Logo Orchestra\" alt=\"Logo Orchestra\" /></a>
\t\t\t<a class=\"githublink\" href=\"\" title=\"Fork me on GitHub\">Fork me on GitHub</a>
\t\t\t<div class=\"leftcontent content\">
\t\t\t\t<div class=\"firststyle\">
\t\t\t\t\t<h2 class=\"orchestra-title\">Orchestra ?</h2>
\t\t\t\t</div>
\t\t\t\t<p>Symfony 2 is the best framework made for PHP...really, it's the most powerfull framework...but symfony 2 is not simple to use...Try to install FOSuser, sonata bundle should be a nightmare for a developper....</p>
\t\t\t\t<p>The purpose of orchestra is to simplify the developper's work.</p>
\t\t\t\t<p>Symfony allow you to speed up the creation and maintenance of your PHP web applications*1, Orchestra allow you to start quickly your developpement.</p>
\t\t\t\t<p>In fact we did not reinvent the wheel, we just choose the best bundle made for Symfony.</p>
\t\t\t\t<p>Our modest contribution to symfony 2 is our ocAppAdminBundle  and our wondefull BootStrap.</p>
\t\t\t</div>
\t\t\t<div class=\"rightcontent content\">
\t\t\t\t<div class=\"firststyle\">
\t\t\t\t\t<h2>Want to play with us ?</h2>
\t\t\t\t</div>
\t\t\t\t<div class=\"box\">
\t\t\t\t\t<p>Get Orchestra on</p>
\t\t\t\t\t<div>
\t\t\t\t\t\t<a href=\"\" title=\"GitHub\">
\t\t\t\t\t\t\tGitHub
\t\t\t\t\t\t\t<span id=\"moving_arrow\"><!-- --></span>
\t\t\t\t\t\t</a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"firststyle\">
\t\t\t\t\t<h3>Orchestra Choose for you</h3>
\t\t\t\t</div>
\t\t\t\t<p>FOSUserBundle, SonataMediaBundle, etc...</p>
\t\t\t</div>
\t\t\t<div class=\"clearer\"><!-- --></div>
\t\t\t<div class=\"leftcontent content\">
\t\t\t\t<div class=\"firststyle\">
\t\t\t\t\t<h3>Why use Orchestra ?</h3>
\t\t\t\t</div>
\t\t\t\t<p>Orchestra is not just the description you just read above. It also allows you to create your own CMS. It's a CMF easy to use, build your own template (layout), add your own custom block with your own logic, build all the widget you need. That it what Orcherstra is made for.</p>
\t\t\t</div>
\t\t\t<div class=\"rightcontent content\">
\t\t\t\t<div class=\"secondstyle\">
\t\t\t\t\t<h3>About Novedia</h3>
\t\t\t\t</div>
\t\t\t\t<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat adipiscing malesuada. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam erat volutpat.</p>
\t\t\t\t<a class=\"contact\" href=\"\" title=\"Contact Us\">Contact Us</a>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"clearer\"><!-- --></div>
\t\t\t";
        // line 78
        $this->displayBlock('content', $context, $blocks);
        echo "\t            
\t\t\t<div class=\"clearer\"><!-- --></div>
\t\t\t
\t\t\t<div class=\"footer\">
\t\t\t\t";
        // line 82
        $this->env->loadTemplate("BootStrapUserBundle::connexion.html.twig")->display($context);
        // line 83
        echo "\t\t\t\t<p>
\t\t\t\t\t<a href=\"";
        // line 84
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("pi_layout_choisir_langue", array("langue" => "fr")), "html", null, true);
        echo "\" title=\"\">FR</a> | <a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("pi_layout_choisir_langue", array("langue" => "en")), "html", null, true);
        echo "\" title=\"\">EN</a> - All rights reserved
\t\t\t\t</p>
\t\t\t</div>
\t\t</div>
\t\t\t\t     
";
    }

    // line 78
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "PiAppTemplateBundle::Template\\Layout\\Pc\\layout-pi-orchestra.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 78,  141 => 84,  138 => 83,  136 => 82,  129 => 78,  78 => 32,  73 => 29,  70 => 28,  47 => 9,  44 => 8,  98 => 30,  93 => 29,  82 => 22,  77 => 21,  71 => 19,  67 => 18,  62 => 17,  56 => 13,  50 => 12,  45 => 15,  42 => 9,  38 => 6,  35 => 6,  32 => 4,  27 => 1,  24 => 2,);
    }
}
