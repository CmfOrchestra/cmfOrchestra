<?php

/* PiAppTemplateBundle:Template\Flash:flash.html.twig */
class __TwigTemplate_f101ddddf98bce2bf00675fe19dc8533 extends Twig_Template
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
        // line 14
        echo "
";
    }

    // line 1
    public function getflash($type = null, $message = null, $close = null)
    {
        $context = $this->env->mergeGlobals(array(
            "type" => $type,
            "message" => $message,
            "close" => $close,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 2
            echo "\t<div class=\"alert-message ";
            if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
            echo twig_escape_filter($this->env, $_type_, "html", null, true);
            echo "\" data-alert=\"alert\" title=\"";
            if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
            echo twig_escape_filter($this->env, $_type_, "html", null, true);
            echo "\">
\t\t";
            // line 3
            if (isset($context["close"])) { $_close_ = $context["close"]; } else { $_close_ = null; }
            if (((array_key_exists("close", $context)) ? (_twig_default_filter($_close_, false)) : (false))) {
                echo " 
\t\t\t<a class=\"close\" href=\"#\">×</a>
\t\t";
            }
            // line 6
            echo "\t\t<p>
\t\t\t";
            // line 7
            if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
            if (($_type_ != "success")) {
                // line 8
                echo "\t\t\t<span class=\"ui-icon ui-icon-circle-check\"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
\t\t\t";
            }
            // line 10
            echo "\t\t\t";
            if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($_message_), "html", null, true);
            echo "
\t\t</p>
\t</div>
";
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    // line 15
    public function getsession_flash($type = null)
    {
        $context = $this->env->mergeGlobals(array(
            "type" => $type,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 16
            echo "\t";
            $context["types"] = array(0 => "success", 1 => "notice", 2 => "error", 3 => "warning");
            // line 17
            echo "\t";
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute($_app_, "session"), "getFlashes", array(), "method")) > 0)) {
                // line 18
                echo "\t<div id=\"symfony-layout-flash\" title=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("pi.session.flash.title"), "html", null, true);
                echo "\">
            ";
                // line 19
                if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
                if (((array_key_exists("type", $context)) ? (_twig_default_filter($_type_, false)) : (false))) {
                    // line 20
                    echo "            ";
                } else {
                    // line 21
                    echo "            
            \t";
                    // line 22
                    if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
                    if ($this->getAttribute($this->getAttribute($_app_, "session"), "hasFlash", array(0 => "only"), "method")) {
                        // line 23
                        echo "            \t\t";
                        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
                        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
                        echo $this->getAttribute($this, "flash", array(0 => $_type_, 1 => $this->getAttribute($this->getAttribute($_app_, "session"), "flash", array(0 => "only"), "method")), "method");
                        echo "
            \t";
                    } else {
                        // line 25
                        echo "\t                ";
                        if (isset($context["types"])) { $_types_ = $context["types"]; } else { $_types_ = null; }
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable($_types_);
                        foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
                            // line 26
                            echo "\t                    ";
                            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
                            if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
                            if ($this->getAttribute($this->getAttribute($_app_, "session"), "hasFlash", array(0 => $_type_), "method")) {
                                // line 27
                                echo "\t                        ";
                                if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
                                if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
                                echo $this->getAttribute($this, "flash", array(0 => $_type_, 1 => $this->getAttribute($this->getAttribute($_app_, "session"), "flash", array(0 => $_type_), "method")), "method");
                                echo "
\t                    ";
                            }
                            // line 29
                            echo "\t                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
                        $context = array_merge($_parent, array_intersect_key($context, $_parent));
                        echo "            \t
            \t";
                    }
                    // line 31
                    echo "
            ";
                }
                // line 33
                echo "\t</div>
\t";
            }
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    public function getTemplateName()
    {
        return "PiAppTemplateBundle:Template\\Flash:flash.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  149 => 31,  140 => 29,  132 => 27,  127 => 26,  110 => 22,  107 => 21,  104 => 20,  101 => 19,  96 => 18,  92 => 17,  89 => 16,  61 => 10,  57 => 8,  22 => 1,  17 => 14,  284 => 95,  282 => 94,  276 => 92,  273 => 91,  268 => 74,  263 => 68,  258 => 65,  250 => 60,  246 => 38,  243 => 37,  240 => 36,  235 => 19,  230 => 15,  224 => 129,  221 => 128,  215 => 127,  212 => 126,  209 => 125,  205 => 124,  203 => 123,  199 => 121,  191 => 119,  189 => 118,  184 => 116,  177 => 114,  173 => 113,  166 => 111,  162 => 103,  160 => 102,  151 => 91,  147 => 89,  145 => 88,  130 => 75,  128 => 74,  121 => 25,  119 => 68,  113 => 23,  108 => 62,  106 => 36,  100 => 33,  95 => 32,  81 => 23,  79 => 22,  63 => 15,  54 => 7,  51 => 6,  46 => 10,  40 => 7,  37 => 6,  34 => 5,  31 => 4,  28 => 3,  26 => 2,  153 => 33,  141 => 84,  138 => 83,  136 => 82,  129 => 78,  78 => 15,  73 => 19,  70 => 28,  47 => 9,  44 => 3,  98 => 30,  93 => 31,  82 => 22,  77 => 21,  71 => 19,  67 => 16,  62 => 17,  56 => 13,  50 => 12,  45 => 15,  42 => 9,  38 => 6,  35 => 2,  32 => 4,  27 => 1,  24 => 1,);
    }
}
