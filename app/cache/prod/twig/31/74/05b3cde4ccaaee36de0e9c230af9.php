<?php

/* PiAppTemplateBundle:Template\Form:fields.html.twig */
class __TwigTemplate_317405b3cde4ccaaee36de0e9c230af9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("form_div_layout.html.twig");

        $this->blocks = array(
            'form_legend' => array($this, 'block_form_legend'),
            'generic_label' => array($this, 'block_generic_label'),
            'field_label_attr_aware_label' => array($this, 'block_field_label_attr_aware_label'),
            'field_help' => array($this, 'block_field_help'),
            'field_widget_remove_btn' => array($this, 'block_field_widget_remove_btn'),
            'form_errors' => array($this, 'block_form_errors'),
            'field_errors' => array($this, 'block_field_errors'),
            'error_type' => array($this, 'block_error_type'),
            'collection_widget' => array($this, 'block_collection_widget'),
            'form_widget2' => array($this, 'block_form_widget2'),
            'field_rows_widget' => array($this, 'block_field_rows_widget'),
            'form_widget' => array($this, 'block_form_widget'),
            'field_rows' => array($this, 'block_field_rows'),
            'field_row' => array($this, 'block_field_row'),
            'date_widget' => array($this, 'block_date_widget'),
            'time_widget' => array($this, 'block_time_widget'),
            'file_widget' => array($this, 'block_file_widget'),
            'datetime_widget' => array($this, 'block_datetime_widget'),
            'radio_widget' => array($this, 'block_radio_widget'),
            'choice_widget' => array($this, 'block_choice_widget'),
            'field_widget' => array($this, 'block_field_widget'),
            'textarea_widget' => array($this, 'block_textarea_widget'),
            'widget_attributes' => array($this, 'block_widget_attributes'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "form_div_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_form_legend($context, array $blocks = array())
    {
        // line 6
        echo "          <legend>";
        if (isset($context["label"])) { $_label_ = $context["label"]; } else { $_label_ = null; }
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($_label_), "html", null, true);
        echo "</legend>
";
    }

    // line 9
    public function block_generic_label($context, array $blocks = array())
    {
        // line 10
        ob_start();
        // line 11
        echo "    ";
        if (isset($context["required"])) { $_required_ = $context["required"]; } else { $_required_ = null; }
        if ($_required_) {
            // line 12
            echo "        ";
            if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
            $context["attr"] = twig_array_merge($_attr_, array("class" => ((($this->getAttribute($_attr_, "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_attr_, "class"), "")) : ("")) . " required")));
            // line 13
            echo "    ";
        }
        // line 14
        echo "    <label";
        if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_attr_);
        foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
            echo " ";
            if (isset($context["attrname"])) { $_attrname_ = $context["attrname"]; } else { $_attrname_ = null; }
            echo twig_escape_filter($this->env, $_attrname_, "html", null, true);
            echo "=\"";
            if (isset($context["attrvalue"])) { $_attrvalue_ = $context["attrvalue"]; } else { $_attrvalue_ = null; }
            echo twig_escape_filter($this->env, $_attrvalue_, "html", null, true);
            echo "\"";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo ">
    ";
        // line 15
        if (isset($context["label"])) { $_label_ = $context["label"]; } else { $_label_ = null; }
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($_label_), "html", null, true);
        echo "
    ";
        // line 16
        if (isset($context["required"])) { $_required_ = $context["required"]; } else { $_required_ = null; }
        if ($_required_) {
            echo "*";
        }
        // line 17
        echo "    ";
        if (isset($context["help_label"])) { $_help_label_ = $context["help_label"]; } else { $_help_label_ = null; }
        if ($_help_label_) {
            // line 18
            echo "        <span class=\"help-block\">";
            if (isset($context["help_label"])) { $_help_label_ = $context["help_label"]; } else { $_help_label_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($_help_label_), "html", null, true);
            echo "</span>
    ";
        }
        // line 20
        echo "    </label>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 26
    public function block_field_label_attr_aware_label($context, array $blocks = array())
    {
        // line 27
        ob_start();
        // line 28
        echo "    ";
        if (isset($context["label_render"])) { $_label_render_ = $context["label_render"]; } else { $_label_render_ = null; }
        if ($_label_render_) {
            // line 29
            echo "    ";
            if (isset($context["label_attr"])) { $_label_attr_ = $context["label_attr"]; } else { $_label_attr_ = null; }
            if (isset($context["id"])) { $_id_ = $context["id"]; } else { $_id_ = null; }
            $context["attr"] = twig_array_merge($_label_attr_, array("for" => $_id_));
            // line 30
            echo "    ";
            $this->displayBlock("field_label", $context, $blocks);
            echo "
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 37
    public function block_field_help($context, array $blocks = array())
    {
        // line 38
        echo "   \t";
        if (isset($context["help_inline"])) { $_help_inline_ = $context["help_inline"]; } else { $_help_inline_ = null; }
        if ($_help_inline_) {
            echo "<span class=\"help-inline\">";
            if (isset($context["help_inline"])) { $_help_inline_ = $context["help_inline"]; } else { $_help_inline_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($_help_inline_), "html", null, true);
            echo "</span>";
        }
        // line 39
        echo "    ";
        if (isset($context["help_block"])) { $_help_block_ = $context["help_block"]; } else { $_help_block_ = null; }
        if ($_help_block_) {
            echo "<span class=\"help-block\">";
            if (isset($context["help_block"])) { $_help_block_ = $context["help_block"]; } else { $_help_block_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($_help_block_), "html", null, true);
            echo "</span>";
        }
    }

    // line 42
    public function block_field_widget_remove_btn($context, array $blocks = array())
    {
        // line 43
        echo "    ";
        if (isset($context["widget_remove_btn"])) { $_widget_remove_btn_ = $context["widget_remove_btn"]; } else { $_widget_remove_btn_ = null; }
        if ($_widget_remove_btn_) {
            // line 44
            echo "    <input type=\"button\" class=\"removebtn\" value=\"";
            if (isset($context["widget_remove_btn"])) { $_widget_remove_btn_ = $context["widget_remove_btn"]; } else { $_widget_remove_btn_ = null; }
            echo twig_escape_filter($this->env, $_widget_remove_btn_, "html", null, true);
            echo "\">
    ";
        }
    }

    // line 50
    public function block_form_errors($context, array $blocks = array())
    {
        // line 51
        ob_start();
        // line 52
        if (isset($context["error_delay"])) { $_error_delay_ = $context["error_delay"]; } else { $_error_delay_ = null; }
        if ($_error_delay_) {
            // line 53
            echo "    ";
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_form_);
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                // line 54
                echo "        ";
                if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
                if (($this->getAttribute($_loop_, "index") == 1)) {
                    // line 55
                    echo "            ";
                    if (isset($context["child"])) { $_child_ = $context["child"]; } else { $_child_ = null; }
                    if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
                    if ($this->getAttribute($_child_, "set", array(0 => "errors", 1 => $_errors_), "method")) {
                    }
                    // line 56
                    echo "        ";
                }
                // line 57
                echo "    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
        } else {
            // line 60
            $context["__internal_a9465509b3f4aff22ab0a40b6c0e647198fc0e45"] = $this->env->loadTemplate("PiAppTemplateBundle:Template\\Flash:flash.html.twig");
            // line 61
            echo "\t<div class=\"symfony-form-errors\" title=\"Alert Errors\">
\t";
            // line 62
            if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
            if ((twig_length_filter($this->env, $_errors_) > 0)) {
                // line 63
                echo "\t\t";
                echo $context["__internal_a9465509b3f4aff22ab0a40b6c0e647198fc0e45"]->getflash("error", "pi.session.flash.form.errors");
                echo "
    \t";
                // line 64
                if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($_errors_);
                foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                    // line 65
                    echo "    \t\t";
                    if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
                    if ((twig_length_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($_error_, "messageTemplate"), $this->getAttribute($_error_, "messageParameters"), "validators")) > 0)) {
                        // line 66
                        echo "\t\t\t";
                        if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
                        echo $context["__internal_a9465509b3f4aff22ab0a40b6c0e647198fc0e45"]->getflash("error", $this->env->getExtension('translator')->trans($this->getAttribute($_error_, "messageTemplate"), $this->getAttribute($_error_, "messageParameters"), "validators"));
                        echo "
\t\t\t";
                    }
                    // line 68
                    echo "\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 69
                echo "\t";
            }
            // line 70
            echo "\t</div>
";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 75
    public function block_field_errors($context, array $blocks = array())
    {
        // line 76
        ob_start();
        // line 77
        echo "    ";
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ((twig_length_filter($this->env, $_errors_) > 0)) {
            // line 78
            echo "\t    <span class=\"help-";
            $this->displayBlock("error_type", $context, $blocks);
            echo "\">
\t        ";
            // line 79
            if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_errors_);
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 80
                echo "\t            ";
                if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($_error_, "messageTemplate"), $this->getAttribute($_error_, "messageParameters"), "validators"), "html", null, true);
                echo " <br>
\t        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 82
            echo "    \t</span>
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 88
    public function block_error_type($context, array $blocks = array())
    {
        // line 89
        ob_start();
        // line 90
        if (isset($context["field_error_type"])) { $_field_error_type_ = $context["field_error_type"]; } else { $_field_error_type_ = null; }
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ($_field_error_type_) {
            // line 91
            if (isset($context["field_error_type"])) { $_field_error_type_ = $context["field_error_type"]; } else { $_field_error_type_ = null; }
            echo twig_escape_filter($this->env, $_field_error_type_, "html", null, true);
            echo "
";
        } elseif (($this->getAttribute($_form_, "hasParent", array(), "method") != 0)) {
            // line 93
            echo "    ";
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            $context["form"] = $this->getAttribute($_form_, "parent");
            // line 94
            echo "    ";
            $this->displayBlock("error_type", $context, $blocks);
            echo "
";
        } elseif (($this->getAttribute($_form_, "hasParent", array(), "method") == 0)) {
            // line 96
            echo "    ";
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_form_, "get", array(0 => "error_type"), "method"), "html", null, true);
            echo "
";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 103
    public function block_collection_widget($context, array $blocks = array())
    {
        // line 104
        echo "   \t";
        $this->displayBlock("form_widget2", $context, $blocks);
        echo "
";
    }

    // line 107
    public function block_form_widget2($context, array $blocks = array())
    {
        // line 108
        echo "    ";
        if (array_key_exists("prototype", $context)) {
            // line 109
            echo "\t    <script type=\"text/html\" id=\"prototype_script_";
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo twig_escape_filter($this->env, $_name_, "html", null, true);
            echo "\" >
\t        ";
            // line 110
            if (isset($context["prototype"])) { $_prototype_ = $context["prototype"]; } else { $_prototype_ = null; }
            echo $this->env->getExtension('form')->renderRow($_prototype_);
            echo "
\t    </script>
    ";
        }
        // line 113
        echo "    ";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ((twig_in_filter("form", $this->getAttribute($_form_, "get", array(0 => "types"), "method")) && ($this->getAttribute($_form_, "hasParent", array(), "method") == 0))) {
            // line 114
            echo "    <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
    \t<fieldset>
    \t";
            // line 116
            if (isset($context["show_legend"])) { $_show_legend_ = $context["show_legend"]; } else { $_show_legend_ = null; }
            if ($_show_legend_) {
                $this->displayBlock("form_legend", $context, $blocks);
            }
            // line 117
            echo "    ";
        }
        // line 118
        echo "    \t<div id=\"prototype_all_widgets_";
        if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
        echo twig_escape_filter($this->env, $_name_, "html", null, true);
        echo "\">
        \t";
        // line 119
        $this->displayBlock("field_rows_widget", $context, $blocks);
        echo "    
        \t";
        // line 120
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo $this->env->getExtension('form')->renderRest($_form_);
        echo "
        </div>
    ";
        // line 122
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ((twig_in_filter("form", $this->getAttribute($_form_, "get", array(0 => "types"), "method")) && ($this->getAttribute($_form_, "hasParent", array(), "method") == 0))) {
            // line 123
            echo "        </fieldset>
    </div>
    ";
        }
        // line 125
        echo " 
";
    }

    // line 128
    public function block_field_rows_widget($context, array $blocks = array())
    {
        // line 129
        ob_start();
        // line 130
        echo "\t";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo $this->env->getExtension('form')->renderErrors($_form_);
        echo "
    ";
        // line 131
        $context["count"] = 0;
        // line 132
        echo "    ";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_form_);
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 133
            echo "    \t<div id=\"";
            if (isset($context["name"])) { $_name_ = $context["name"]; } else { $_name_ = null; }
            echo twig_escape_filter($this->env, $_name_, "html", null, true);
            echo "_";
            if (isset($context["count"])) { $_count_ = $context["count"]; } else { $_count_ = null; }
            echo twig_escape_filter($this->env, $_count_, "html", null, true);
            echo "\">
        \t";
            // line 134
            if (isset($context["child"])) { $_child_ = $context["child"]; } else { $_child_ = null; }
            echo $this->env->getExtension('form')->renderRow($_child_);
            echo "
        </div>
        ";
            // line 136
            if (isset($context["count"])) { $_count_ = $context["count"]; } else { $_count_ = null; }
            $context["count"] = ($_count_ + 1);
            // line 137
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 143
    public function block_form_widget($context, array $blocks = array())
    {
        // line 144
        echo "    ";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ((twig_in_filter("form", $this->getAttribute($_form_, "get", array(0 => "types"), "method")) && ($this->getAttribute($_form_, "hasParent", array(), "method") == 0))) {
            // line 145
            echo "    <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
    \t<fieldset>
    \t";
            // line 147
            if (isset($context["show_legend"])) { $_show_legend_ = $context["show_legend"]; } else { $_show_legend_ = null; }
            if ($_show_legend_) {
                $this->displayBlock("form_legend", $context, $blocks);
            }
            // line 148
            echo "    ";
        }
        // line 149
        echo "        \t";
        $this->displayBlock("field_rows", $context, $blocks);
        echo "    
        \t";
        // line 150
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo $this->env->getExtension('form')->renderRest($_form_);
        echo "
    ";
        // line 151
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ((twig_in_filter("form", $this->getAttribute($_form_, "get", array(0 => "types"), "method")) && ($this->getAttribute($_form_, "hasParent", array(), "method") == 0))) {
            // line 152
            echo "        </fieldset>
    </div>
    ";
        }
        // line 154
        echo " 
";
    }

    // line 157
    public function block_field_rows($context, array $blocks = array())
    {
        // line 158
        echo "    ";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo $this->env->getExtension('form')->renderErrors($_form_);
        echo "
    ";
        // line 159
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_form_, "children"));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 160
            echo "        ";
            if (isset($context["child"])) { $_child_ = $context["child"]; } else { $_child_ = null; }
            echo $this->env->getExtension('form')->renderRow($_child_);
            echo "
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
    }

    // line 164
    public function block_field_row($context, array $blocks = array())
    {
        // line 165
        echo "    ";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ((!twig_in_filter("form", $this->getAttribute($_form_, "get", array(0 => "types"), "method")))) {
            // line 166
            echo "    <div class=\"clearfix ";
            if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
            if ((twig_length_filter($this->env, $_errors_) > 0)) {
                echo "error";
            }
            echo "\">
    ";
        }
        // line 168
        echo "\t\t\t\t
        ";
        // line 169
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ((twig_in_filter("form", $this->getAttribute($_form_, "get", array(0 => "types"), "method")) && ($this->getAttribute($_form_, "hasParent", array(), "method") != 0))) {
            // line 170
            echo "            ";
            if (isset($context["show_child_legend"])) { $_show_child_legend_ = $context["show_child_legend"]; } else { $_show_child_legend_ = null; }
            if ($_show_child_legend_) {
                // line 171
                echo "                ";
                $this->displayBlock("form_legend", $context, $blocks);
                echo "
            ";
            }
            // line 173
            echo "    \t";
        } else {
            // line 174
            echo "        \t";
            $this->displayBlock("field_label_attr_aware_label", $context, $blocks);
            echo "
        ";
        }
        // line 175
        echo " 
        
    ";
        // line 177
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ((!twig_in_filter("form", $this->getAttribute($_form_, "get", array(0 => "types"), "method")))) {
            // line 178
            echo "        <div class=\"input\">
    ";
        }
        // line 180
        echo "            ";
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ((twig_length_filter($this->env, $_errors_) > 0)) {
            // line 181
            echo "                ";
            if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
            $context["attr"] = twig_array_merge($_attr_, array("class" => ((($this->getAttribute($_attr_, "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_attr_, "class"), "")) : ("")) . " error")));
            // line 182
            echo "            ";
        }
        // line 183
        echo "            ";
        if (isset($context["widget_prefix"])) { $_widget_prefix_ = $context["widget_prefix"]; } else { $_widget_prefix_ = null; }
        echo twig_escape_filter($this->env, $_widget_prefix_, "html", null, true);
        echo "
            ";
        // line 184
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo $this->env->getExtension('form')->renderWidget($_form_);
        echo "
            ";
        // line 185
        if (isset($context["widget_suffix"])) { $_widget_suffix_ = $context["widget_suffix"]; } else { $_widget_suffix_ = null; }
        echo twig_escape_filter($this->env, $_widget_suffix_, "html", null, true);
        echo "
    ";
        // line 186
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if ((!twig_in_filter("form", $this->getAttribute($_form_, "get", array(0 => "types"), "method")))) {
            // line 187
            echo "        ";
            if (array_key_exists("widget_remove_btn", $context)) {
                // line 188
                echo "            ";
                $this->displayBlock("field_widget_remove_btn", $context, $blocks);
                echo "
        ";
            }
            // line 190
            echo "\t        ";
            $this->displayBlock("field_help", $context, $blocks);
            echo "
            ";
            // line 191
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo $this->env->getExtension('form')->renderErrors($_form_);
            echo "
        </div>
    </div>
    ";
        }
        // line 194
        echo "  
";
    }

    // line 200
    public function block_date_widget($context, array $blocks = array())
    {
        // line 201
        ob_start();
        // line 202
        echo "    ";
        if (isset($context["widget"])) { $_widget_ = $context["widget"]; } else { $_widget_ = null; }
        if (($_widget_ == "single_text")) {
            // line 203
            echo "        ";
            $this->displayBlock("field_widget", $context, $blocks);
            echo "
    ";
        } else {
            // line 205
            echo "    <div class=\"clearfix ";
            if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
            if ((twig_length_filter($this->env, $_errors_) > 0)) {
                echo "error";
            }
            echo "\">
    \t";
            // line 206
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            if (isset($context["label"])) { $_label_ = $context["label"]; } else { $_label_ = null; }
            echo $this->env->getExtension('form')->renderLabel($_form_, $_label_);
            echo "
        <div class=\"input\">
            ";
            // line 208
            if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
            $context["attr"] = twig_array_merge($_attr_, array("class" => ((($this->getAttribute($_attr_, "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_attr_, "class"), "")) : ("")) . " inline-inputs")));
            // line 209
            echo "\t        <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
\t            ";
            // line 210
            if (isset($context["date_pattern"])) { $_date_pattern_ = $context["date_pattern"]; } else { $_date_pattern_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
            echo strtr($_date_pattern_, array("{{ year }}" => $this->env->getExtension('form')->renderWidget($this->getAttribute($_form_, "year"), array("attr" => array("class" => (($this->getAttribute($_attr_, "widget_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_attr_, "widget_class"), "")) : (""))))), "{{ month }}" => $this->env->getExtension('form')->renderWidget($this->getAttribute($_form_, "month"), array("attr" => array("class" => (($this->getAttribute($_attr_, "widget_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_attr_, "widget_class"), "")) : (""))))), "{{ day }}" => $this->env->getExtension('form')->renderWidget($this->getAttribute($_form_, "day"), array("attr" => array("class" => (($this->getAttribute($_attr_, "widget_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_attr_, "widget_class"), "")) : ("")))))));
            // line 214
            echo "
\t        </div>
\t        ";
            // line 216
            $this->displayBlock("help", $context, $blocks);
            echo "
        </div>
    </div>
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 223
    public function block_time_widget($context, array $blocks = array())
    {
        // line 224
        ob_start();
        // line 225
        echo "    ";
        if (isset($context["widget"])) { $_widget_ = $context["widget"]; } else { $_widget_ = null; }
        if (($_widget_ == "single_text")) {
            // line 226
            echo "        ";
            $this->displayBlock("field_widget", $context, $blocks);
            echo "
    ";
        } else {
            // line 228
            echo "    <div class=\"clearfix ";
            if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
            if ((twig_length_filter($this->env, $_errors_) > 0)) {
                echo "error";
            }
            echo "\">
                ";
            // line 229
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            if (isset($context["label"])) { $_label_ = $context["label"]; } else { $_label_ = null; }
            echo $this->env->getExtension('form')->renderLabel($_form_, $_label_);
            echo "
        <div class=\"input\">
            ";
            // line 231
            if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
            $context["attr"] = twig_array_merge($_attr_, array("class" => ((($this->getAttribute($_attr_, "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_attr_, "class"), "")) : ("")) . " inline-inputs")));
            // line 232
            echo "            <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
                    ";
            // line 233
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
            echo $this->env->getExtension('form')->renderWidget($this->getAttribute($_form_, "hour"), array("attr" => array("class" => (($this->getAttribute($_attr_, "widget_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_attr_, "widget_class"), "")) : ("")))));
            echo "
                    ";
            // line 234
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
            echo $this->env->getExtension('form')->renderWidget($this->getAttribute($_form_, "minute"), array("attr" => array("class" => (($this->getAttribute($_attr_, "widget_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_attr_, "widget_class"), "")) : ("")))));
            echo "
            </div>
            ";
            // line 236
            $this->displayBlock("help", $context, $blocks);
            echo "
        </div>
    </div>
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 244
    public function block_file_widget($context, array $blocks = array())
    {
        // line 245
        ob_start();
        // line 246
        echo "    <div class=\"";
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ((twig_length_filter($this->env, $_errors_) > 0)) {
            echo "error";
        }
        echo "\">
    \t<picture id=\"";
        // line 247
        if (isset($context["id"])) { $_id_ = $context["id"]; } else { $_id_ = null; }
        echo twig_escape_filter($this->env, $_id_, "html", null, true);
        echo "\" class=\"media\" ></picture>
\t\t";
        // line 248
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo $this->env->getExtension('form')->renderWidget($_form_);
        echo "
    </div>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 253
    public function block_datetime_widget($context, array $blocks = array())
    {
        // line 254
        ob_start();
        // line 255
        echo "    ";
        if (isset($context["widget"])) { $_widget_ = $context["widget"]; } else { $_widget_ = null; }
        if (($_widget_ == "single_text")) {
            // line 256
            echo "        ";
            $this->displayBlock("field_widget", $context, $blocks);
            echo "
    ";
        } else {
            // line 258
            echo "    <div class=\"clearfix ";
            if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
            if ((twig_length_filter($this->env, $_errors_) > 0)) {
                echo "error";
            }
            echo "\">
    \t";
            // line 259
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            if (isset($context["label"])) { $_label_ = $context["label"]; } else { $_label_ = null; }
            echo $this->env->getExtension('form')->renderLabel($_form_, $_label_);
            echo "
        <div class=\"input\">
            ";
            // line 261
            if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
            $context["attr"] = twig_array_merge($_attr_, array("class" => ((($this->getAttribute($_attr_, "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_attr_, "class"), "")) : ("")) . " inline-inputs")));
            // line 262
            echo "\t        <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
\t            ";
            // line 263
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo $this->env->getExtension('form')->renderErrors($this->getAttribute($_form_, "date"));
            echo "
\t            ";
            // line 264
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo $this->env->getExtension('form')->renderErrors($this->getAttribute($_form_, "time"));
            echo "
\t            ";
            // line 265
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
            echo $this->env->getExtension('form')->renderWidget($this->getAttribute($_form_, "date"), array("attr" => array("class" => (($this->getAttribute($_attr_, "widget_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_attr_, "widget_class"), "")) : ("")))));
            echo "
\t            ";
            // line 266
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
            echo $this->env->getExtension('form')->renderWidget($this->getAttribute($_form_, "time"), array("attr" => array("class" => (($this->getAttribute($_attr_, "widget_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_attr_, "widget_class"), "")) : ("")))));
            echo "
\t        </div>
\t        ";
            // line 268
            $this->displayBlock("field_help", $context, $blocks);
            echo "
        </div>
    </div>
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 278
    public function block_radio_widget($context, array $blocks = array())
    {
        // line 279
        ob_start();
        // line 280
        echo "    <input type=\"radio\" ";
        $this->displayBlock("widget_attributes", $context, $blocks);
        if (array_key_exists("value", $context)) {
            echo " value=\"";
            if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
            echo twig_escape_filter($this->env, $_value_, "html", null, true);
            echo "\"";
        }
        if (isset($context["checked"])) { $_checked_ = $context["checked"]; } else { $_checked_ = null; }
        if ($_checked_) {
            echo " checked=\"checked\"";
        }
        echo " />
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 284
    public function block_choice_widget($context, array $blocks = array())
    {
        // line 285
        ob_start();
        // line 286
        echo "    ";
        if (isset($context["expanded"])) { $_expanded_ = $context["expanded"]; } else { $_expanded_ = null; }
        if ($_expanded_) {
            // line 287
            echo "    <div class=\"clearfix\">
\t\t";
            // line 288
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            if (isset($context["label"])) { $_label_ = $context["label"]; } else { $_label_ = null; }
            echo $this->env->getExtension('form')->renderLabel($_form_, $_label_);
            echo "
\t\t<div class=\"input choice\">
\t\t\t";
            // line 290
            if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
            $context["attr"] = twig_array_merge($_attr_, array("class" => ((($this->getAttribute($_attr_, "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_attr_, "class"), "")) : ("")) . " inputs-list")));
            // line 291
            echo "        \t<ul ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
\t        ";
            // line 292
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_form_);
            foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                // line 293
                echo "                <li>
                \t<label>
\t\t            \t";
                // line 295
                if (isset($context["child"])) { $_child_ = $context["child"]; } else { $_child_ = null; }
                if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
                echo $this->env->getExtension('form')->renderWidget($_child_, array("attr" => array("class" => (($this->getAttribute($_attr_, "widget_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_attr_, "widget_class"), "")) : ("")))));
                echo "
\t\t            \t<span>";
                // line 296
                if (isset($context["child"])) { $_child_ = $context["child"]; } else { $_child_ = null; }
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($_child_, "get", array(0 => "label"), "method")), "html", null, true);
                echo "</span>
\t                </label>
                </li>
\t        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 300
            echo "\t\t\t</ul>
\t\t</div>
\t\t<div class=\"input choice\">
\t\t\t";
            // line 303
            $this->displayBlock("field_errors", $context, $blocks);
            echo "
\t\t</div>
\t</div>
   ";
        } else {
            // line 307
            echo "   <select ";
            $this->displayBlock("widget_attributes", $context, $blocks);
            if (isset($context["multiple"])) { $_multiple_ = $context["multiple"]; } else { $_multiple_ = null; }
            if ($_multiple_) {
                echo " multiple=\"multiple\"";
            }
            echo ">
        ";
            // line 308
            if (isset($context["empty_value"])) { $_empty_value_ = $context["empty_value"]; } else { $_empty_value_ = null; }
            if ((!(null === $_empty_value_))) {
                // line 309
                echo "            <option value=\"\">";
                if (isset($context["empty_value"])) { $_empty_value_ = $context["empty_value"]; } else { $_empty_value_ = null; }
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($_empty_value_), "html", null, true);
                echo "</option>
        ";
            }
            // line 311
            echo "        ";
            if (isset($context["preferred_choices"])) { $_preferred_choices_ = $context["preferred_choices"]; } else { $_preferred_choices_ = null; }
            if ((twig_length_filter($this->env, $_preferred_choices_) > 0)) {
                // line 312
                echo "            ";
                if (isset($context["preferred_choices"])) { $_preferred_choices_ = $context["preferred_choices"]; } else { $_preferred_choices_ = null; }
                $context["options"] = $_preferred_choices_;
                // line 313
                echo "            ";
                $this->displayBlock("widget_choice_options", $context, $blocks);
                echo "
            ";
                // line 314
                if (isset($context["choices"])) { $_choices_ = $context["choices"]; } else { $_choices_ = null; }
                if ((twig_length_filter($this->env, $_choices_) > 0)) {
                    // line 315
                    echo "                <option disabled=\"disabled\">";
                    if (isset($context["separator"])) { $_separator_ = $context["separator"]; } else { $_separator_ = null; }
                    echo twig_escape_filter($this->env, $_separator_, "html", null, true);
                    echo "</option>
            ";
                }
                // line 317
                echo "        ";
            }
            // line 318
            echo "        ";
            if (isset($context["choices"])) { $_choices_ = $context["choices"]; } else { $_choices_ = null; }
            $context["options"] = $_choices_;
            // line 319
            echo "        ";
            $this->displayBlock("widget_choice_options", $context, $blocks);
            echo "
   </select>
   ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 325
    public function block_field_widget($context, array $blocks = array())
    {
        // line 326
        ob_start();
        // line 327
        echo "    ";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter($_type_, "text")) : ("text"));
        // line 328
        echo "    <input type=\"";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        echo twig_escape_filter($this->env, $_type_, "html", null, true);
        echo "\" ";
        $this->displayBlock("widget_attributes", $context, $blocks);
        echo " value=\"";
        if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
        echo twig_escape_filter($this->env, $_value_, "html", null, true);
        echo "\" />
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 332
    public function block_textarea_widget($context, array $blocks = array())
    {
        // line 333
        ob_start();
        // line 334
        echo "\t";
        if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
        $context["attr"] = $_attr_;
        // line 335
        echo "    <textarea ";
        $this->displayBlock("widget_attributes", $context, $blocks);
        echo ">";
        if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
        echo twig_escape_filter($this->env, $_value_, "html", null, true);
        echo "</textarea>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 341
    public function block_widget_attributes($context, array $blocks = array())
    {
        // line 342
        ob_start();
        // line 343
        echo "    id=\"";
        if (isset($context["id"])) { $_id_ = $context["id"]; } else { $_id_ = null; }
        echo twig_escape_filter($this->env, $_id_, "html", null, true);
        echo "\" name=\"";
        if (isset($context["full_name"])) { $_full_name_ = $context["full_name"]; } else { $_full_name_ = null; }
        echo twig_escape_filter($this->env, $_full_name_, "html", null, true);
        echo "\"";
        if (isset($context["read_only"])) { $_read_only_ = $context["read_only"]; } else { $_read_only_ = null; }
        if ($_read_only_) {
            echo " disabled=\"disabled\"";
        }
        if (isset($context["required"])) { $_required_ = $context["required"]; } else { $_required_ = null; }
        if ($_required_) {
            echo " required=\"required\"";
        }
        if (isset($context["max_length"])) { $_max_length_ = $context["max_length"]; } else { $_max_length_ = null; }
        if ($_max_length_) {
            echo " maxlength=\"";
            if (isset($context["max_length"])) { $_max_length_ = $context["max_length"]; } else { $_max_length_ = null; }
            echo twig_escape_filter($this->env, $_max_length_, "html", null, true);
            echo "\"";
        }
        if (isset($context["pattern"])) { $_pattern_ = $context["pattern"]; } else { $_pattern_ = null; }
        if ($_pattern_) {
            echo " pattern=\"";
            if (isset($context["pattern"])) { $_pattern_ = $context["pattern"]; } else { $_pattern_ = null; }
            echo twig_escape_filter($this->env, $_pattern_, "html", null, true);
            echo "\"";
        }
        echo " 
    ";
        // line 344
        if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_attr_);
        foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
            if (isset($context["attrname"])) { $_attrname_ = $context["attrname"]; } else { $_attrname_ = null; }
            echo twig_escape_filter($this->env, $_attrname_, "html", null, true);
            echo "=\"";
            if (isset($context["attrvalue"])) { $_attrvalue_ = $context["attrvalue"]; } else { $_attrvalue_ = null; }
            echo twig_escape_filter($this->env, $_attrvalue_, "html", null, true);
            echo "\" ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "PiAppTemplateBundle:Template\\Form:fields.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1098 => 344,  1066 => 343,  1061 => 341,  1050 => 335,  1046 => 334,  1044 => 333,  1041 => 332,  1027 => 328,  1023 => 327,  1021 => 326,  1018 => 325,  1008 => 319,  1004 => 318,  1001 => 317,  994 => 315,  986 => 313,  982 => 312,  978 => 311,  971 => 309,  968 => 308,  959 => 307,  936 => 296,  930 => 295,  916 => 291,  906 => 288,  903 => 287,  899 => 286,  897 => 285,  894 => 284,  876 => 280,  871 => 278,  854 => 266,  833 => 262,  830 => 261,  823 => 259,  815 => 258,  809 => 256,  805 => 255,  803 => 254,  791 => 248,  786 => 247,  778 => 246,  776 => 245,  763 => 236,  756 => 234,  750 => 233,  745 => 232,  742 => 231,  735 => 229,  727 => 228,  717 => 225,  715 => 224,  712 => 223,  702 => 216,  698 => 214,  693 => 210,  688 => 209,  685 => 208,  678 => 206,  664 => 203,  660 => 202,  658 => 201,  655 => 200,  650 => 194,  637 => 190,  628 => 187,  615 => 184,  609 => 183,  606 => 182,  602 => 181,  598 => 180,  594 => 178,  591 => 177,  587 => 175,  578 => 173,  572 => 171,  568 => 170,  565 => 169,  562 => 168,  553 => 166,  546 => 164,  523 => 158,  520 => 157,  515 => 154,  510 => 152,  502 => 150,  497 => 149,  494 => 148,  489 => 147,  483 => 145,  479 => 144,  476 => 143,  467 => 137,  464 => 136,  449 => 133,  443 => 132,  435 => 130,  433 => 129,  420 => 123,  411 => 120,  401 => 118,  393 => 116,  387 => 114,  383 => 113,  376 => 110,  370 => 109,  367 => 108,  364 => 107,  357 => 104,  354 => 103,  344 => 96,  338 => 94,  334 => 93,  328 => 91,  324 => 90,  322 => 89,  319 => 88,  302 => 80,  292 => 78,  288 => 77,  283 => 75,  276 => 70,  267 => 68,  260 => 66,  256 => 65,  243 => 62,  240 => 61,  238 => 60,  220 => 56,  210 => 54,  174 => 44,  156 => 39,  130 => 29,  121 => 26,  108 => 18,  51 => 6,  48 => 5,  1094 => 291,  1088 => 290,  1086 => 289,  1083 => 288,  1064 => 342,  1034 => 283,  1032 => 282,  1029 => 281,  1016 => 276,  1011 => 275,  1005 => 274,  1003 => 273,  1000 => 272,  991 => 314,  984 => 264,  980 => 263,  974 => 262,  972 => 261,  969 => 260,  962 => 255,  952 => 303,  947 => 300,  944 => 251,  940 => 250,  938 => 249,  935 => 248,  926 => 293,  924 => 243,  921 => 292,  913 => 290,  910 => 236,  901 => 231,  896 => 230,  890 => 229,  887 => 228,  885 => 227,  882 => 226,  874 => 279,  872 => 221,  869 => 220,  861 => 268,  859 => 213,  856 => 212,  848 => 265,  843 => 264,  841 => 206,  838 => 263,  813 => 201,  810 => 200,  806 => 199,  802 => 198,  800 => 253,  797 => 196,  789 => 190,  785 => 189,  783 => 188,  780 => 187,  773 => 244,  769 => 183,  766 => 182,  758 => 178,  754 => 177,  752 => 176,  749 => 175,  730 => 171,  726 => 170,  724 => 169,  721 => 226,  713 => 164,  709 => 163,  707 => 162,  704 => 161,  696 => 157,  692 => 156,  690 => 155,  687 => 154,  679 => 150,  675 => 149,  673 => 148,  670 => 205,  661 => 143,  659 => 142,  656 => 141,  648 => 137,  644 => 136,  642 => 191,  639 => 134,  631 => 188,  627 => 129,  625 => 186,  623 => 127,  620 => 185,  613 => 121,  601 => 120,  596 => 119,  590 => 117,  586 => 116,  584 => 115,  581 => 174,  573 => 108,  569 => 104,  564 => 103,  558 => 101,  554 => 100,  552 => 99,  549 => 165,  539 => 92,  534 => 160,  529 => 159,  524 => 89,  519 => 88,  513 => 86,  509 => 85,  507 => 151,  504 => 83,  486 => 79,  484 => 78,  481 => 77,  463 => 73,  461 => 72,  458 => 134,  448 => 65,  444 => 64,  441 => 131,  434 => 61,  430 => 128,  425 => 125,  421 => 58,  417 => 122,  410 => 55,  407 => 119,  398 => 117,  394 => 51,  385 => 49,  379 => 48,  374 => 47,  369 => 46,  365 => 45,  363 => 44,  360 => 43,  351 => 39,  335 => 37,  331 => 35,  312 => 82,  307 => 32,  301 => 31,  297 => 79,  291 => 29,  289 => 28,  286 => 76,  275 => 23,  273 => 69,  270 => 21,  262 => 17,  259 => 16,  254 => 15,  251 => 64,  249 => 13,  246 => 63,  237 => 7,  233 => 6,  228 => 5,  226 => 4,  223 => 57,  219 => 288,  216 => 287,  214 => 55,  211 => 280,  209 => 272,  206 => 271,  203 => 269,  201 => 260,  198 => 259,  196 => 248,  193 => 247,  191 => 53,  185 => 239,  183 => 50,  178 => 226,  175 => 225,  173 => 220,  170 => 43,  165 => 212,  160 => 205,  155 => 196,  149 => 193,  144 => 37,  139 => 181,  137 => 175,  134 => 174,  132 => 168,  127 => 161,  122 => 154,  119 => 153,  117 => 147,  114 => 146,  112 => 141,  109 => 140,  107 => 134,  104 => 17,  102 => 126,  99 => 16,  97 => 114,  94 => 15,  92 => 98,  89 => 97,  87 => 83,  84 => 82,  77 => 71,  74 => 70,  72 => 13,  69 => 42,  67 => 27,  59 => 9,  57 => 12,  49 => 2,  91 => 33,  79 => 76,  66 => 23,  64 => 11,  54 => 11,  32 => 9,  22 => 4,  17 => 1,  188 => 52,  186 => 51,  180 => 235,  177 => 59,  172 => 52,  167 => 42,  162 => 211,  157 => 204,  152 => 195,  147 => 38,  142 => 182,  135 => 30,  131 => 65,  129 => 167,  126 => 28,  124 => 27,  118 => 53,  115 => 20,  113 => 51,  98 => 41,  96 => 34,  88 => 34,  86 => 32,  82 => 77,  80 => 30,  75 => 14,  73 => 26,  68 => 12,  65 => 22,  62 => 10,  60 => 20,  55 => 17,  52 => 3,  50 => 14,  43 => 11,  37 => 8,  29 => 8,  27 => 2,  25 => 1,  40 => 7,  34 => 6,  31 => 4,  28 => 4,  23 => 1,);
    }
}
