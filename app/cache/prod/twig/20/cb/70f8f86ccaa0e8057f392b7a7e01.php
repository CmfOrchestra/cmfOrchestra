<?php

/* PiAppAdminBundle:PageByTrans:edit_view.html.twig */
class __TwigTemplate_20cb70f8f86ccaa0e8057f392b7a7e01 extends Twig_Template
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
        echo "\t<!-- Begin tag markup -->
\t<div id=\"tabs\">
\t\t<ul>
\t\t\t<li><a href=\"#tabs-1\">";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.page.translation.title"), "html", null, true);
        echo "</a> <span class=\"ui-icon ui-icon-close\">Remove
\t\t\t\tTab</span></li>
\t\t</ul>

\t\t";
        // line 8
        if (isset($context["edit_form"])) { $_edit_form_ = $context["edit_form"]; } else { $_edit_form_ = null; }
        echo $this->env->getExtension('form')->setTheme($_edit_form_, array($this->env->getExtension('admin_service_extension')->getParameterFunction("pi_app_admin.layout.template.form"), ));
        // line 9
        echo "\t\t<form class=\"myform\" action=\"";
        if (isset($context["entity"])) { $_entity_ = $context["entity"]; } else { $_entity_ = null; }
        if (isset($context["NoLayout"])) { $_NoLayout_ = $context["NoLayout"]; } else { $_NoLayout_ = null; }
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_pagebytrans_update", array("id" => $this->getAttribute($_entity_, "id"), "NoLayout" => $_NoLayout_)), "html", null, true);
        echo "\" method=\"post\" ";
        if (isset($context["edit_form"])) { $_edit_form_ = $context["edit_form"]; } else { $_edit_form_ = null; }
        echo $this->env->getExtension('form')->renderEnctype($_edit_form_);
        echo " novalidate>
\t\t\t<div id=\"tabs-1\">
\t\t\t\t    ";
        // line 11
        if (isset($context["edit_form"])) { $_edit_form_ = $context["edit_form"]; } else { $_edit_form_ = null; }
        echo $this->env->getExtension('form')->renderWidget($_edit_form_);
        echo " 
\t\t\t</div>
\t\t    <p>
\t\t        <input id=\"add_tab\" type=\"button\" value=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.grid.action.add-tab"), "html", null, true);
        echo "\" />
\t\t        <button type=\"submit\">";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.grid.action.save"), "html", null, true);
        echo "</button>
\t\t    </p>
\t\t</form>

\t</div>
\t<!-- End tag markup -->
\t
\t";
        // line 22
        $context["options"] = array("prototype-name" => array(0 => "translations"), "prototype-tab-title" => "Translate");
        // line 23
        echo "\t";
        if (isset($context["options"])) { $_options_ = $context["options"]; } else { $_options_ = null; }
        echo $this->env->getExtension('admin_jquery_extension')->FactoryFunction("FORM", "prototype-bytab", $_options_);
        echo "
\t
\t<ul class=\"record_actions\">
\t    <li>
\t        <form action=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_pagebytrans"), "html", null, true);
        echo "\" method=\"post\">
\t            <button type=\"submit\">";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.grid.action.back-to-the-list"), "html", null, true);
        echo "</button>
\t        </form>
\t    </li>
\t    <li>
\t        <form action=\"";
        // line 32
        if (isset($context["entity"])) { $_entity_ = $context["entity"]; } else { $_entity_ = null; }
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_pagebytrans_delete", array("id" => $this->getAttribute($_entity_, "id"))), "html", null, true);
        echo "\" method=\"post\">
\t            ";
        // line 33
        if (isset($context["delete_form"])) { $_delete_form_ = $context["delete_form"]; } else { $_delete_form_ = null; }
        echo $this->env->getExtension('form')->renderWidget($_delete_form_);
        echo "
\t            <button type=\"submit\">";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.grid.action.delete"), "html", null, true);
        echo "</button>
\t        </form>
\t    </li>
\t</ul>
\t
\t<script type=\"text/javascript\">
\t// <![CDATA[
\t\$('ul.record_actions').ready(function(){\t\t
\t\tvar allListElements = new Array();\t\t
\t\t\$(\"select[id\$='_heritage']\").each(function(index) {
\t\t\tallListElements[index] = \$(this).parents('.clearfix'); 
\t\t\tallListElements[index].hide();
\t\t});
\t\t
\t\t\$(\"input[id\$='_secure']\").change(function () {
\t\t\tif(\$(this).is(':checked')){
\t\t\t\t\$(\"select[id\$='_heritage']\").each(function(index) {
\t\t\t\t\t\$(this).parents('.no-accordion').find(allListElements[index]).show();
\t\t\t\t});
\t\t\t}else{
\t\t\t\t\$(\"select[id\$='_heritage']\").each(function(index) {
\t\t\t\t\t\$(this).parents('.no-accordion').find(allListElements[index]).hide();
\t\t\t\t});
\t\t\t}
       \t});
\t});
\t// ]]>
\t</script>";
    }

    public function getTemplateName()
    {
        return "PiAppAdminBundle:PageByTrans:edit_view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 33,  79 => 28,  66 => 23,  64 => 22,  54 => 15,  32 => 9,  22 => 4,  17 => 1,  188 => 63,  186 => 62,  180 => 60,  177 => 59,  172 => 52,  167 => 51,  162 => 33,  157 => 30,  152 => 26,  147 => 11,  142 => 8,  135 => 66,  131 => 65,  129 => 59,  126 => 58,  124 => 57,  118 => 53,  115 => 52,  113 => 51,  98 => 41,  96 => 34,  88 => 34,  86 => 32,  82 => 31,  80 => 30,  75 => 27,  73 => 26,  68 => 23,  65 => 22,  62 => 21,  60 => 20,  55 => 17,  52 => 16,  50 => 14,  43 => 11,  37 => 8,  29 => 8,  27 => 2,  25 => 1,  40 => 7,  34 => 6,  31 => 4,  28 => 4,  23 => 1,);
    }
}
