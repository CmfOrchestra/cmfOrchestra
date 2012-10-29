<?php

/* PiAppTemplateBundle::Template\Layout\Pc\layout-pi-admin.html.twig */
class __TwigTemplate_fa3014d86d61e3870c3573197d852709 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("PiAppTemplateBundle::Template\\Layout\\layout-global.html.twig");

        $this->blocks = array(
            'global_title' => array($this, 'block_global_title'),
            'global_meta' => array($this, 'block_global_meta'),
            'global_script_js' => array($this, 'block_global_script_js'),
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
        echo $this->env->getExtension('pi_app_admin')->addCssFile("bundles/piappadmin/css/layout/admin/screen.css");
        // line 2
        echo $this->env->getExtension('admin_jquery_extension')->initJquery("TOOL:languagechoice");
        // line 5
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        $context["global_local_language"] = twig_lower_filter($this->env, $this->getAttribute($this->getAttribute($_app_, "session"), "getLocale", array(), "method"));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 7
    public function block_global_title($context, array $blocks = array())
    {
        echo "Orchestra";
    }

    // line 9
    public function block_global_meta($context, array $blocks = array())
    {
        // line 10
        echo "\t<link rel=\"copyright\" href=\"#copyright\"/>
\t";
        // line 11
        $this->displayParentBlock("global_meta", $context, $blocks);
        echo "
\t<meta charset=\"utf-8\" />
";
    }

    // line 15
    public function block_global_script_js($context, array $blocks = array())
    {
        // line 16
        echo "\t";
        $this->displayParentBlock("global_script_js", $context, $blocks);
        echo "
\t
\t<script src=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/js/jquery/custom_jquery.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>

\t<!-- [if !IE 7]>
\t<script src=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/js/jquery/jquery.selectbox-0.5.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
\t<script type=\"text/javascript\">
\t//<![CDATA[
\t\$(document).ready(function() {
\t\t\$('.styledselect').selectbox({ inputClass: \"selectbox_styled\" });
\t});
\t//]]>
\t</script>
\t<![endif] -->
\t
\t<script src=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/js/jquery/jquery.selectbox-0.5_style_2.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
\t<script type=\"text/javascript\">
\t//<![CDATA[
\t\$(document).ready(function() {
\t\t\$('.styledselect_form_1').selectbox({ inputClass: \"styledselect_form_1\" });
\t\t\$('.styledselect_form_2').selectbox({ inputClass: \"styledselect_form_2\" });
\t});
\t//]]>
\t</script>
\t
\t<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
\t<script src=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/js/jquery/jquery.pngFix.pack.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
\t<script type=\"text/javascript\">
\t//<![CDATA[
\t\$(document).ready(function(){
\t\$(document).pngFix( );
\t});
\t//]]>
\t</script>

";
    }

    // line 54
    public function block_global_layout($context, array $blocks = array())
    {
        // line 55
        echo "\t";
        $this->displayParentBlock("global_layout", $context, $blocks);
        echo "
\t
\t<!-- Start: page-top-outer -->
\t<div id=\"page-top-outer\">    
\t
\t<!-- Start: page-top -->
\t<div id=\"page-top\">
\t
\t\t<!-- start logo -->
\t\t<div id=\"logo\">
\t\t\t<a href=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_homepage"), "html", null, true);
        echo "\" title=\"logo\"><img src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/images/logo/logo-orchestra-white.png"), "html", null, true);
        echo "\" height=\"70\" alt=\"\" /></a>
\t\t</div>
\t\t<!-- end logo -->
\t\t
\t\t";
        // line 96
        echo "\t
\t</div>
\t<!-- End: page-top -->
\t
\t</div>
\t<!-- End: page-top-outer -->
\t\t
\t<div class=\"clear\">&nbsp;</div>
\t 
\t<!--  start nav-outer-repeat................................................................................................. START -->
\t<div class=\"nav-outer-repeat\"> 
\t<!--  start nav-outer -->
\t<div class=\"nav-outer\"> 
\t
\t\t\t<!-- start nav-right -->
\t\t\t<div id=\"nav-right\">
\t\t\t\t";
        // line 112
        $this->env->loadTemplate("PiAppTemplateBundle::Template\\Layout\\Connexion\\connexion.html.twig")->display($context);
        // line 113
        echo "\t\t\t</div>
\t\t\t<!-- end nav-right -->
\t
\t
\t\t\t<!--  start nav -->
\t\t\t<div class=\"nav\">
\t\t\t<div class=\"table\">
\t\t\t
\t\t\t";
        // line 121
        if ($this->env->getExtension('security')->isGranted("ROLE_SUPER_ADMIN")) {
            // line 122
            echo "\t\t\t<ul class=\"select\"><li><a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("sonata_admin_dashboard"), "html", null, true);
            echo "\"><strong>";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu1.title"), "html", null, true);
            echo " Sonata</strong><!--[if IE 7]><!--></a><!--<![endif]-->
\t\t\t<!--[if lte IE 6]><table><tr><td><![endif]-->
\t\t\t<div class=\"select_sub\">
\t\t\t\t<ul class=\"sub\">
\t\t\t\t\t<li><a href=\"";
            // line 126
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_bootstrap_media_media_list"), "html", null, true);
            echo "\" target=\"_blank\" >";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu1.media_media"), "html", null, true);
            echo "</a></li>
\t\t\t\t\t<li><a href=\"";
            // line 127
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_bootstrap_media_gallery_list"), "html", null, true);
            echo "\" target=\"_blank\" >";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu1.media_gallery"), "html", null, true);
            echo "</a></li>
\t\t\t\t\t<li><a style=\"color:#238BDB\" >&#187;</a></li>
\t\t\t\t\t<li><a href=\"";
            // line 129
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_bootstrap_user_group_list"), "html", null, true);
            echo "\" target=\"_blank\" >";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu1.group_list"), "html", null, true);
            echo "</a></li>
\t\t\t\t\t<li><a href=\"";
            // line 130
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_bootstrap_user_user_list"), "html", null, true);
            echo "\"  target=\"_blank\" >";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu1.group_user"), "html", null, true);
            echo "</a></li>
\t\t\t\t\t<li><a href=\"";
            // line 131
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_bootstrap_user_role_list"), "html", null, true);
            echo "\"  target=\"_blank\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu1.group_role"), "html", null, true);
            echo "</a></li>
\t\t\t\t\t<li><a href=\"";
            // line 132
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_bootstrap_user_permission_list"), "html", null, true);
            echo "\" target=\"_blank\" >";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu1.group_permission"), "html", null, true);
            echo "</a></li>
\t\t\t\t\t<li><a style=\"color:#238BDB\" >&#187;</a></li>
\t\t\t\t\t<li><a href=\"";
            // line 134
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_piapp_admin_historicalstatus_list"), "html", null, true);
            echo "\" target=\"_blank\" >";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu1.cms_historicalpage"), "html", null, true);
            echo "</a></li>
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t<!--[if lte IE 6]></td></tr></table></a><![endif]-->
\t\t\t</li>
\t\t\t</ul>
\t\t\t
\t\t\t<div class=\"nav-divider\">&nbsp;</div>
\t\t\t";
        }
        // line 142
        echo "\t
\t\t\t                    
\t\t\t<ul ";
        // line 144
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_layout:admin_pagebytrans:admin_pagecssjs", "class=\"current\"", "class=\"select\"");
        echo " ><li><a href=\"#nogo\"><strong>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu2.title"), "html", null, true);
        echo "</strong><!--[if IE 7]><!--></a><!--<![endif]-->
\t\t\t<!--[if lte IE 6]><table><tr><td><![endif]-->
\t\t\t<div class=\"select_sub ";
        // line 146
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_layout:admin_pagebytrans:admin_pagecssjs", "show");
        echo "\">
\t\t\t\t<ul class=\"sub\">
\t\t\t\t\t<li ";
        // line 148
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_layout", "class=\"sub_show\"");
        echo "\t\t><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_layout"), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu2.layout"), "html", null, true);
        echo "</a></li>
\t\t\t\t\t<li ";
        // line 149
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_pagebytrans", "class=\"sub_show\"");
        echo "\t><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_pagebytrans"), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu2.page"), "html", null, true);
        echo "</a></li>
\t\t\t\t\t<li ";
        // line 150
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_pagecssjs", "class=\"sub_show\"");
        echo "\t><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_pagecssjs"), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu2.cssjs"), "html", null, true);
        echo "</a></li>
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t<!--[if lte IE 6]></td></tr></table></a><![endif]-->
\t\t\t</li>
\t\t\t</ul>
\t\t\t
\t\t\t<div class=\"nav-divider\">&nbsp;</div>
\t\t\t
\t\t\t<ul ";
        // line 159
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_rubrique_tree:admin_keyword:admin_tag:admin_langue", "class=\"current\"", "class=\"select\"");
        echo " ><li><a href=\"#nogo\"><strong>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu3.title"), "html", null, true);
        echo "</strong><!--[if IE 7]><!--></a><!--<![endif]-->
\t\t\t<!--[if lte IE 6]><table><tr><td><![endif]-->
\t\t\t<div class=\"select_sub ";
        // line 161
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_rubrique_tree:admin_keyword:admin_tag:admin_langue", "show");
        echo " \">
\t\t\t\t<ul class=\"sub\">
\t\t\t\t\t<li ";
        // line 163
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_rubrique_tree", "class=\"sub_show\"");
        echo "\t><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_rubrique_tree"), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu3.rubrique"), "html", null, true);
        echo "</a></li>
\t\t\t\t\t<li ";
        // line 164
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_langue", "class=\"sub_show\"");
        echo "\t\t><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_langue"), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu3.language"), "html", null, true);
        echo "</a></li>
\t\t\t\t\t<li ";
        // line 165
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_tag", "class=\"sub_show\"");
        echo "\t\t\t><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_tag"), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu3.tag"), "html", null, true);
        echo "</a></li>
\t\t\t\t\t<li ";
        // line 166
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_keyword", "class=\"sub_show\"");
        echo "\t\t><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_keyword"), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu3.keyword"), "html", null, true);
        echo "</a></li>\t\t\t\t
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t<!--[if lte IE 6]></td></tr></table></a><![endif]-->
\t\t\t</li>
\t\t\t</ul>
\t\t\t
\t\t\t<div class=\"nav-divider\">&nbsp;</div>
\t\t\t
\t\t\t<ul ";
        // line 175
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_gedmo_organigram_tree:admin_gedmo_media:admin_gedmo_category:admin_snippet:admin_gedmo_sicap_picture:admin_gedmo_block:admin_gedmo_content:admin_gedmo_menu:admin_gedmo_slider:admin_gedmo_menu_tree:admin_gedmo_pressrelease:admin_gedmo_contact", "class=\"current\"", "class=\"select\"");
        echo " ><li><a href=\"#nogo\"><strong>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu4.title"), "html", null, true);
        echo "</strong><!--[if IE 7]><!--></a><!--<![endif]-->
\t\t\t<!--[if lte IE 6]><table><tr><td><![endif]-->
\t\t\t<div class=\"select_sub ";
        // line 177
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_gedmo_organigram_tree:admin_gedmo_media:admin_gedmo_category:admin_snippet:admin_gedmo_sicap_picture:admin_gedmo_block:admin_gedmo_content:admin_gedmo_menu:admin_gedmo_slider:admin_gedmo_menu_tree:admin_gedmo_pressrelease:admin_gedmo_contact", "show");
        echo " \">
\t\t\t\t<ul class=\"sub\">
\t\t\t\t\t<li ";
        // line 179
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_snippet", "class=\"sub_show\"");
        echo "\t\t><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_snippet"), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu2.snippet"), "html", null, true);
        echo "</a></li>
\t\t\t\t\t<li><a style=\"color:#238BDB\" >&#187;</a></li>
\t\t\t\t\t<li ";
        // line 181
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_gedmo_slider", "class=\"sub_show\"");
        echo "\t\t\t\t><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_gedmo_slider"), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu4.slider"), "html", null, true);
        echo "</a></li>
\t\t\t\t\t<li ";
        // line 182
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_gedmo_menu_tree", "class=\"sub_show\"");
        echo "\t\t\t\t><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_gedmo_menu_tree", array("category" => "")), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu4.menu"), "html", null, true);
        echo "</a></li>
\t\t\t\t\t<li ";
        // line 183
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_gedmo_organigram_tree", "class=\"sub_show\"");
        echo "\t><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_gedmo_organigram_tree", array("category" => "")), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu4.organigram"), "html", null, true);
        echo "</a></li>
\t\t\t\t\t<li><a style=\"color:#238BDB\" >&#187;</a></li>
\t\t\t\t\t<li ";
        // line 185
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_gedmo_category", "class=\"sub_show\"");
        echo "\t\t\t><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_gedmo_category"), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu4.category"), "html", null, true);
        echo "</a></li>
\t\t\t\t\t<li ";
        // line 186
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_gedmo_block", "class=\"sub_show\"");
        echo "\t\t\t><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_gedmo_block"), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu4.block"), "html", null, true);
        echo "</a></li>
\t\t\t\t\t<li ";
        // line 187
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_gedmo_content", "class=\"sub_show\"");
        echo "\t\t\t\t><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_gedmo_content"), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu4.content"), "html", null, true);
        echo "</a></li>
\t\t\t\t\t<li ";
        // line 188
        echo $this->env->getExtension('admin_tool_extension')->inPathsFunction("admin_gedmo_media", "class=\"sub_show\"");
        echo "\t\t\t\t><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_gedmo_media"), "html", null, true);
        echo "\" >";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.dashboard.menu4.media"), "html", null, true);
        echo "</a></li>
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t<!--[if lte IE 6]></td></tr></table></a><![endif]-->
\t\t\t</li>
\t\t\t</ul>
\t\t\t
\t\t\t<div class=\"clear\"></div>
\t\t\t</div>
\t\t\t<div class=\"clear\"></div>
\t\t\t</div>
\t\t\t<!--  start nav -->

\t
\t</div>
\t<div class=\"clear\"></div>
\t<!--  start nav-outer -->
\t</div>
\t<!--  start nav-outer-repeat................................................... END -->
\t
\t  <div class=\"clear\"></div>
\t 
\t<!-- start content-outer ........................................................................................................................START -->
\t<div id=\"content-outer\">
\t<!-- start content -->
\t<div id=\"content\">
\t
\t\t<!--  start page-heading -->
\t\t<div id=\"page-heading\">
\t\t\t";
        // line 217
        $this->displayBlock("title", $context, $blocks);
        echo "
\t\t</div>
\t\t<!-- end page-heading -->
\t
\t\t<table id=\"content-table\">
\t\t<tr>
\t\t\t<th rowspan=\"3\" class=\"sized\"><img src=\"";
        // line 223
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/images/shared/side_shadowleft.jpg"), "html", null, true);
        echo "\" width=\"20\" height=\"300\" alt=\"\" /></th>
\t\t\t<th class=\"topleft\"></th>
\t\t\t<td id=\"tbl-border-top\">&nbsp;</td>
\t\t\t<th class=\"topright\"></th>
\t\t\t<th rowspan=\"3\" class=\"sized\"><img src=\"";
        // line 227
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/images/shared/side_shadowright.jpg"), "html", null, true);
        echo "\" width=\"20\" height=\"300\" alt=\"\" /></th>
\t\t</tr>
\t\t<tr>
\t\t\t<td id=\"tbl-border-left\"></td>
\t\t\t<td>
\t\t\t<!--  start content-table-inner ...................................................................... START -->
\t\t\t<div id=\"content-table-inner\">
\t\t\t
\t\t\t\t<!--  start table-content  -->
\t\t\t\t<div id=\"table-content\">
\t\t            ";
        // line 237
        $this->displayBlock('content', $context, $blocks);
        // line 238
        echo "\t\t\t\t\t\t
\t\t\t\t</div>
\t\t\t\t<!--  end table-content  -->
\t\t
\t\t\t\t<div class=\"clear\"></div>
\t\t\t 
\t\t\t</div>
\t\t\t<!--  end content-table-inner ............................................END  -->
\t\t\t</td>
\t\t\t<td id=\"tbl-border-right\"></td>
\t\t</tr>
\t\t<tr>
\t\t\t<th class=\"sized bottomleft\"></th>
\t\t\t<td id=\"tbl-border-bottom\">&nbsp;</td>
\t\t\t<th class=\"sized bottomright\"></th>
\t\t</tr>
\t\t</table>
\t\t<div class=\"clear\">&nbsp;</div>
\t
\t</div>
\t<!--  end content -->
\t<div class=\"clear\">&nbsp;</div>
\t</div>
\t<!--  end content-outer........................................................END -->
\t
\t<div class=\"clear\">&nbsp;</div>
\t    
\t<!-- start footer -->         
\t<div id=\"footer\">
\t<!-- <div id=\"footer-pad\">&nbsp;</div> -->
\t\t<!--  start footer-left -->
\t\t<div id=\"footer-left\">
\t\t\t<a rel='Copyright' href='http://www.cmf-orchestra.net/#Copyright' id='copyright'>";
        // line 270
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.footer.copyright"), "html", null, true);
        echo "</a> © 2004-";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " Ltd. <a href=\"\" title=\"\">www.cmf-orchestra.net</a>.
\t\t\t<img src=\"";
        // line 271
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/piappadmin/images/logo/html5-badge.png"), "html", null, true);
        echo "\" alt=\"html5 validated by contactpfelix@gmail.com\" />
\t\t\t<div class=\"clear\"><!-- --></div>
\t\t</div>
\t\t<!--  end footer-left -->
\t\t<div class=\"clear\"><!-- --></div>
\t</div>
\t<!-- end footer -->

\t\t\t\t     
";
    }

    // line 237
    public function block_content($context, array $blocks = array())
    {
        // line 238
        echo "\t\t            ";
    }

    public function getTemplateName()
    {
        return "PiAppTemplateBundle::Template\\Layout\\Pc\\layout-pi-admin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  526 => 238,  523 => 237,  509 => 271,  503 => 270,  469 => 238,  467 => 237,  454 => 227,  447 => 223,  438 => 217,  402 => 188,  394 => 187,  386 => 186,  378 => 185,  369 => 183,  361 => 182,  353 => 181,  344 => 179,  339 => 177,  332 => 175,  316 => 166,  308 => 165,  300 => 164,  292 => 163,  287 => 161,  280 => 159,  264 => 150,  256 => 149,  248 => 148,  243 => 146,  236 => 144,  232 => 142,  218 => 134,  211 => 132,  205 => 131,  199 => 130,  193 => 129,  186 => 127,  180 => 126,  170 => 122,  168 => 121,  158 => 113,  156 => 112,  138 => 96,  129 => 65,  115 => 55,  112 => 54,  98 => 42,  84 => 31,  71 => 21,  65 => 18,  59 => 16,  56 => 15,  43 => 9,  37 => 7,  31 => 5,  29 => 2,  27 => 1,  54 => 11,  49 => 11,  46 => 10,  42 => 8,  39 => 7,  36 => 6,  28 => 4,  22 => 1,);
    }
}
