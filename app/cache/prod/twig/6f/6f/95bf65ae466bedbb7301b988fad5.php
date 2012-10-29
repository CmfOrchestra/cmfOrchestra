<?php

/* form_div_layout.html.twig */
class __TwigTemplate_6f6f95bf65ae466bedbb7301b988fad5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'form_widget' => array($this, 'block_form_widget'),
            'collection_widget' => array($this, 'block_collection_widget'),
            'textarea_widget' => array($this, 'block_textarea_widget'),
            'widget_choice_options' => array($this, 'block_widget_choice_options'),
            'choice_widget' => array($this, 'block_choice_widget'),
            'checkbox_widget' => array($this, 'block_checkbox_widget'),
            'radio_widget' => array($this, 'block_radio_widget'),
            'datetime_widget' => array($this, 'block_datetime_widget'),
            'date_widget' => array($this, 'block_date_widget'),
            'time_widget' => array($this, 'block_time_widget'),
            'number_widget' => array($this, 'block_number_widget'),
            'integer_widget' => array($this, 'block_integer_widget'),
            'money_widget' => array($this, 'block_money_widget'),
            'url_widget' => array($this, 'block_url_widget'),
            'search_widget' => array($this, 'block_search_widget'),
            'percent_widget' => array($this, 'block_percent_widget'),
            'field_widget' => array($this, 'block_field_widget'),
            'password_widget' => array($this, 'block_password_widget'),
            'hidden_widget' => array($this, 'block_hidden_widget'),
            'email_widget' => array($this, 'block_email_widget'),
            'generic_label' => array($this, 'block_generic_label'),
            'field_label' => array($this, 'block_field_label'),
            'form_label' => array($this, 'block_form_label'),
            'repeated_row' => array($this, 'block_repeated_row'),
            'field_row' => array($this, 'block_field_row'),
            'hidden_row' => array($this, 'block_hidden_row'),
            'field_enctype' => array($this, 'block_field_enctype'),
            'field_errors' => array($this, 'block_field_errors'),
            'field_rest' => array($this, 'block_field_rest'),
            'field_rows' => array($this, 'block_field_rows'),
            'widget_attributes' => array($this, 'block_widget_attributes'),
            'widget_container_attributes' => array($this, 'block_widget_container_attributes'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "
";
        // line 3
        $this->displayBlock('form_widget', $context, $blocks);
        // line 11
        echo "
";
        // line 12
        $this->displayBlock('collection_widget', $context, $blocks);
        // line 20
        echo "
";
        // line 21
        $this->displayBlock('textarea_widget', $context, $blocks);
        // line 26
        echo "
";
        // line 27
        $this->displayBlock('widget_choice_options', $context, $blocks);
        // line 42
        echo "
";
        // line 43
        $this->displayBlock('choice_widget', $context, $blocks);
        // line 70
        echo "
";
        // line 71
        $this->displayBlock('checkbox_widget', $context, $blocks);
        // line 76
        echo "
";
        // line 77
        $this->displayBlock('radio_widget', $context, $blocks);
        // line 82
        echo "
";
        // line 83
        $this->displayBlock('datetime_widget', $context, $blocks);
        // line 97
        echo "
";
        // line 98
        $this->displayBlock('date_widget', $context, $blocks);
        // line 113
        echo "
";
        // line 114
        $this->displayBlock('time_widget', $context, $blocks);
        // line 125
        echo "
";
        // line 126
        $this->displayBlock('number_widget', $context, $blocks);
        // line 133
        echo "
";
        // line 134
        $this->displayBlock('integer_widget', $context, $blocks);
        // line 140
        echo "
";
        // line 141
        $this->displayBlock('money_widget', $context, $blocks);
        // line 146
        echo "
";
        // line 147
        $this->displayBlock('url_widget', $context, $blocks);
        // line 153
        echo "
";
        // line 154
        $this->displayBlock('search_widget', $context, $blocks);
        // line 160
        echo "
";
        // line 161
        $this->displayBlock('percent_widget', $context, $blocks);
        // line 167
        echo "
";
        // line 168
        $this->displayBlock('field_widget', $context, $blocks);
        // line 174
        echo "
";
        // line 175
        $this->displayBlock('password_widget', $context, $blocks);
        // line 181
        echo "
";
        // line 182
        $this->displayBlock('hidden_widget', $context, $blocks);
        // line 186
        echo "
";
        // line 187
        $this->displayBlock('email_widget', $context, $blocks);
        // line 193
        echo "
";
        // line 195
        echo "
";
        // line 196
        $this->displayBlock('generic_label', $context, $blocks);
        // line 204
        echo "
";
        // line 205
        $this->displayBlock('field_label', $context, $blocks);
        // line 211
        echo "
";
        // line 212
        $this->displayBlock('form_label', $context, $blocks);
        // line 217
        echo "
";
        // line 219
        echo "
";
        // line 220
        $this->displayBlock('repeated_row', $context, $blocks);
        // line 225
        echo "
";
        // line 226
        $this->displayBlock('field_row', $context, $blocks);
        // line 235
        echo "
";
        // line 236
        $this->displayBlock('hidden_row', $context, $blocks);
        // line 239
        echo "
";
        // line 241
        echo "
";
        // line 242
        $this->displayBlock('field_enctype', $context, $blocks);
        // line 247
        echo "
";
        // line 248
        $this->displayBlock('field_errors', $context, $blocks);
        // line 259
        echo "
";
        // line 260
        $this->displayBlock('field_rest', $context, $blocks);
        // line 269
        echo "
";
        // line 271
        echo "
";
        // line 272
        $this->displayBlock('field_rows', $context, $blocks);
        // line 280
        echo "
";
        // line 281
        $this->displayBlock('widget_attributes', $context, $blocks);
        // line 287
        echo "
";
        // line 288
        $this->displayBlock('widget_container_attributes', $context, $blocks);
    }

    // line 3
    public function block_form_widget($context, array $blocks = array())
    {
        // line 4
        ob_start();
        // line 5
        echo "    <div ";
        $this->displayBlock("widget_container_attributes", $context, $blocks);
        echo ">
        ";
        // line 6
        $this->displayBlock("field_rows", $context, $blocks);
        echo "
        ";
        // line 7
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo $this->env->getExtension('form')->renderRest($_form_);
        echo "
    </div>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 12
    public function block_collection_widget($context, array $blocks = array())
    {
        // line 13
        ob_start();
        // line 14
        echo "    ";
        if (array_key_exists("prototype", $context)) {
            // line 15
            echo "        ";
            if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
            if (isset($context["prototype"])) { $_prototype_ = $context["prototype"]; } else { $_prototype_ = null; }
            $context["attr"] = twig_array_merge($_attr_, array("data-prototype" => $this->env->getExtension('form')->renderRow($_prototype_)));
            // line 16
            echo "    ";
        }
        // line 17
        echo "    ";
        $this->displayBlock("form_widget", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 21
    public function block_textarea_widget($context, array $blocks = array())
    {
        // line 22
        ob_start();
        // line 23
        echo "    <textarea ";
        $this->displayBlock("widget_attributes", $context, $blocks);
        echo ">";
        if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
        echo twig_escape_filter($this->env, $_value_, "html", null, true);
        echo "</textarea>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 27
    public function block_widget_choice_options($context, array $blocks = array())
    {
        // line 28
        ob_start();
        // line 29
        echo "    ";
        if (isset($context["options"])) { $_options_ = $context["options"]; } else { $_options_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_options_);
        foreach ($context['_seq'] as $context["choice"] => $context["label"]) {
            // line 30
            echo "        ";
            if (isset($context["label"])) { $_label_ = $context["label"]; } else { $_label_ = null; }
            if ($this->env->getExtension('form')->isChoiceGroup($_label_)) {
                // line 31
                echo "            <optgroup label=\"";
                if (isset($context["choice"])) { $_choice_ = $context["choice"]; } else { $_choice_ = null; }
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($_choice_), "html", null, true);
                echo "\">
                ";
                // line 32
                if (isset($context["label"])) { $_label_ = $context["label"]; } else { $_label_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($_label_);
                foreach ($context['_seq'] as $context["nestedChoice"] => $context["nestedLabel"]) {
                    // line 33
                    echo "                    <option value=\"";
                    if (isset($context["nestedChoice"])) { $_nestedChoice_ = $context["nestedChoice"]; } else { $_nestedChoice_ = null; }
                    echo twig_escape_filter($this->env, $_nestedChoice_, "html", null, true);
                    echo "\"";
                    if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
                    if (isset($context["nestedChoice"])) { $_nestedChoice_ = $context["nestedChoice"]; } else { $_nestedChoice_ = null; }
                    if ($this->env->getExtension('form')->isChoiceSelected($_form_, $_nestedChoice_)) {
                        echo " selected=\"selected\"";
                    }
                    echo ">";
                    if (isset($context["nestedLabel"])) { $_nestedLabel_ = $context["nestedLabel"]; } else { $_nestedLabel_ = null; }
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($_nestedLabel_), "html", null, true);
                    echo "</option>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['nestedChoice'], $context['nestedLabel'], $context['_parent'], $context['loop']);
                $context = array_merge($_parent, array_intersect_key($context, $_parent));
                // line 35
                echo "            </optgroup>
        ";
            } else {
                // line 37
                echo "            <option value=\"";
                if (isset($context["choice"])) { $_choice_ = $context["choice"]; } else { $_choice_ = null; }
                echo twig_escape_filter($this->env, $_choice_, "html", null, true);
                echo "\"";
                if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
                if (isset($context["choice"])) { $_choice_ = $context["choice"]; } else { $_choice_ = null; }
                if ($this->env->getExtension('form')->isChoiceSelected($_form_, $_choice_)) {
                    echo " selected=\"selected\"";
                }
                echo ">";
                if (isset($context["label"])) { $_label_ = $context["label"]; } else { $_label_ = null; }
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($_label_), "html", null, true);
                echo "</option>
        ";
            }
            // line 39
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['choice'], $context['label'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 43
    public function block_choice_widget($context, array $blocks = array())
    {
        // line 44
        ob_start();
        // line 45
        echo "    ";
        if (isset($context["expanded"])) { $_expanded_ = $context["expanded"]; } else { $_expanded_ = null; }
        if ($_expanded_) {
            // line 46
            echo "        <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
        ";
            // line 47
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_form_);
            foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                // line 48
                echo "            ";
                if (isset($context["child"])) { $_child_ = $context["child"]; } else { $_child_ = null; }
                echo $this->env->getExtension('form')->renderWidget($_child_);
                echo "
            ";
                // line 49
                if (isset($context["child"])) { $_child_ = $context["child"]; } else { $_child_ = null; }
                echo $this->env->getExtension('form')->renderLabel($_child_);
                echo "
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 51
            echo "        </div>
    ";
        } else {
            // line 53
            echo "    <select ";
            $this->displayBlock("widget_attributes", $context, $blocks);
            if (isset($context["multiple"])) { $_multiple_ = $context["multiple"]; } else { $_multiple_ = null; }
            if ($_multiple_) {
                echo " multiple=\"multiple\"";
            }
            echo ">
        ";
            // line 54
            if (isset($context["empty_value"])) { $_empty_value_ = $context["empty_value"]; } else { $_empty_value_ = null; }
            if ((!(null === $_empty_value_))) {
                // line 55
                echo "            <option value=\"\">";
                if (isset($context["empty_value"])) { $_empty_value_ = $context["empty_value"]; } else { $_empty_value_ = null; }
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($_empty_value_), "html", null, true);
                echo "</option>
        ";
            }
            // line 57
            echo "        ";
            if (isset($context["preferred_choices"])) { $_preferred_choices_ = $context["preferred_choices"]; } else { $_preferred_choices_ = null; }
            if ((twig_length_filter($this->env, $_preferred_choices_) > 0)) {
                // line 58
                echo "            ";
                if (isset($context["preferred_choices"])) { $_preferred_choices_ = $context["preferred_choices"]; } else { $_preferred_choices_ = null; }
                $context["options"] = $_preferred_choices_;
                // line 59
                echo "            ";
                $this->displayBlock("widget_choice_options", $context, $blocks);
                echo "
            ";
                // line 60
                if (isset($context["choices"])) { $_choices_ = $context["choices"]; } else { $_choices_ = null; }
                if (isset($context["separator"])) { $_separator_ = $context["separator"]; } else { $_separator_ = null; }
                if (((twig_length_filter($this->env, $_choices_) > 0) && (!(null === $_separator_)))) {
                    // line 61
                    echo "                <option disabled=\"disabled\">";
                    if (isset($context["separator"])) { $_separator_ = $context["separator"]; } else { $_separator_ = null; }
                    echo twig_escape_filter($this->env, $_separator_, "html", null, true);
                    echo "</option>
            ";
                }
                // line 63
                echo "        ";
            }
            // line 64
            echo "        ";
            if (isset($context["choices"])) { $_choices_ = $context["choices"]; } else { $_choices_ = null; }
            $context["options"] = $_choices_;
            // line 65
            echo "        ";
            $this->displayBlock("widget_choice_options", $context, $blocks);
            echo "
    </select>
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 71
    public function block_checkbox_widget($context, array $blocks = array())
    {
        // line 72
        ob_start();
        // line 73
        echo "    <input type=\"checkbox\" ";
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

    // line 77
    public function block_radio_widget($context, array $blocks = array())
    {
        // line 78
        ob_start();
        // line 79
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

    // line 83
    public function block_datetime_widget($context, array $blocks = array())
    {
        // line 84
        ob_start();
        // line 85
        echo "    ";
        if (isset($context["widget"])) { $_widget_ = $context["widget"]; } else { $_widget_ = null; }
        if (($_widget_ == "single_text")) {
            // line 86
            echo "        ";
            $this->displayBlock("field_widget", $context, $blocks);
            echo "
    ";
        } else {
            // line 88
            echo "        <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
            ";
            // line 89
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo $this->env->getExtension('form')->renderErrors($this->getAttribute($_form_, "date"));
            echo "
            ";
            // line 90
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo $this->env->getExtension('form')->renderErrors($this->getAttribute($_form_, "time"));
            echo "
            ";
            // line 91
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo $this->env->getExtension('form')->renderWidget($this->getAttribute($_form_, "date"));
            echo "
            ";
            // line 92
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo $this->env->getExtension('form')->renderWidget($this->getAttribute($_form_, "time"));
            echo "
        </div>
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 98
    public function block_date_widget($context, array $blocks = array())
    {
        // line 99
        ob_start();
        // line 100
        echo "    ";
        if (isset($context["widget"])) { $_widget_ = $context["widget"]; } else { $_widget_ = null; }
        if (($_widget_ == "single_text")) {
            // line 101
            echo "        ";
            $this->displayBlock("field_widget", $context, $blocks);
            echo "
    ";
        } else {
            // line 103
            echo "        <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
            ";
            // line 104
            if (isset($context["date_pattern"])) { $_date_pattern_ = $context["date_pattern"]; } else { $_date_pattern_ = null; }
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo strtr($_date_pattern_, array("{{ year }}" => $this->env->getExtension('form')->renderWidget($this->getAttribute($_form_, "year")), "{{ month }}" => $this->env->getExtension('form')->renderWidget($this->getAttribute($_form_, "month")), "{{ day }}" => $this->env->getExtension('form')->renderWidget($this->getAttribute($_form_, "day"))));
            // line 108
            echo "
        </div>
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 114
    public function block_time_widget($context, array $blocks = array())
    {
        // line 115
        ob_start();
        // line 116
        echo "    ";
        if (isset($context["widget"])) { $_widget_ = $context["widget"]; } else { $_widget_ = null; }
        if (($_widget_ == "single_text")) {
            // line 117
            echo "        ";
            $this->displayBlock("field_widget", $context, $blocks);
            echo "
    ";
        } else {
            // line 119
            echo "        <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
            ";
            // line 120
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo $this->env->getExtension('form')->renderWidget($this->getAttribute($_form_, "hour"), array("attr" => array("size" => "1")));
            echo ":";
            if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
            echo $this->env->getExtension('form')->renderWidget($this->getAttribute($_form_, "minute"), array("attr" => array("size" => "1")));
            if (isset($context["with_seconds"])) { $_with_seconds_ = $context["with_seconds"]; } else { $_with_seconds_ = null; }
            if ($_with_seconds_) {
                echo ":";
                if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
                echo $this->env->getExtension('form')->renderWidget($this->getAttribute($_form_, "second"), array("attr" => array("size" => "1")));
            }
            // line 121
            echo "        </div>
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 126
    public function block_number_widget($context, array $blocks = array())
    {
        // line 127
        ob_start();
        // line 128
        echo "    ";
        // line 129
        echo "    ";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter($_type_, "text")) : ("text"));
        // line 130
        echo "    ";
        $this->displayBlock("field_widget", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 134
    public function block_integer_widget($context, array $blocks = array())
    {
        // line 135
        ob_start();
        // line 136
        echo "    ";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter($_type_, "number")) : ("number"));
        // line 137
        echo "    ";
        $this->displayBlock("field_widget", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 141
    public function block_money_widget($context, array $blocks = array())
    {
        // line 142
        ob_start();
        // line 143
        echo "    ";
        if (isset($context["money_pattern"])) { $_money_pattern_ = $context["money_pattern"]; } else { $_money_pattern_ = null; }
        echo strtr($_money_pattern_, array("{{ widget }}" => $this->renderBlock("field_widget", $context, $blocks)));
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 147
    public function block_url_widget($context, array $blocks = array())
    {
        // line 148
        ob_start();
        // line 149
        echo "    ";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter($_type_, "url")) : ("url"));
        // line 150
        echo "    ";
        $this->displayBlock("field_widget", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 154
    public function block_search_widget($context, array $blocks = array())
    {
        // line 155
        ob_start();
        // line 156
        echo "    ";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter($_type_, "search")) : ("search"));
        // line 157
        echo "    ";
        $this->displayBlock("field_widget", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 161
    public function block_percent_widget($context, array $blocks = array())
    {
        // line 162
        ob_start();
        // line 163
        echo "    ";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter($_type_, "text")) : ("text"));
        // line 164
        echo "    ";
        $this->displayBlock("field_widget", $context, $blocks);
        echo " %
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 168
    public function block_field_widget($context, array $blocks = array())
    {
        // line 169
        ob_start();
        // line 170
        echo "    ";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter($_type_, "text")) : ("text"));
        // line 171
        echo "    <input type=\"";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        echo twig_escape_filter($this->env, $_type_, "html", null, true);
        echo "\" ";
        $this->displayBlock("widget_attributes", $context, $blocks);
        echo " ";
        if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
        if ((!twig_test_empty($_value_))) {
            echo "value=\"";
            if (isset($context["value"])) { $_value_ = $context["value"]; } else { $_value_ = null; }
            echo twig_escape_filter($this->env, $_value_, "html", null, true);
            echo "\" ";
        }
        echo "/>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 175
    public function block_password_widget($context, array $blocks = array())
    {
        // line 176
        ob_start();
        // line 177
        echo "    ";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter($_type_, "password")) : ("password"));
        // line 178
        echo "    ";
        $this->displayBlock("field_widget", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 182
    public function block_hidden_widget($context, array $blocks = array())
    {
        // line 183
        echo "    ";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter($_type_, "hidden")) : ("hidden"));
        // line 184
        echo "    ";
        $this->displayBlock("field_widget", $context, $blocks);
        echo "
";
    }

    // line 187
    public function block_email_widget($context, array $blocks = array())
    {
        // line 188
        ob_start();
        // line 189
        echo "    ";
        if (isset($context["type"])) { $_type_ = $context["type"]; } else { $_type_ = null; }
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter($_type_, "email")) : ("email"));
        // line 190
        echo "    ";
        $this->displayBlock("field_widget", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 196
    public function block_generic_label($context, array $blocks = array())
    {
        // line 197
        ob_start();
        // line 198
        echo "    ";
        if (isset($context["required"])) { $_required_ = $context["required"]; } else { $_required_ = null; }
        if ($_required_) {
            // line 199
            echo "        ";
            if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
            $context["attr"] = twig_array_merge($_attr_, array("class" => ((($this->getAttribute($_attr_, "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($_attr_, "class"), "")) : ("")) . " required")));
            // line 200
            echo "    ";
        }
        // line 201
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
        echo ">";
        if (isset($context["label"])) { $_label_ = $context["label"]; } else { $_label_ = null; }
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($_label_), "html", null, true);
        echo "</label>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 205
    public function block_field_label($context, array $blocks = array())
    {
        // line 206
        ob_start();
        // line 207
        echo "    ";
        if (isset($context["attr"])) { $_attr_ = $context["attr"]; } else { $_attr_ = null; }
        if (isset($context["id"])) { $_id_ = $context["id"]; } else { $_id_ = null; }
        $context["attr"] = twig_array_merge($_attr_, array("for" => $_id_));
        // line 208
        echo "    ";
        $this->displayBlock("generic_label", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 212
    public function block_form_label($context, array $blocks = array())
    {
        // line 213
        ob_start();
        // line 214
        echo "    ";
        $this->displayBlock("generic_label", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 220
    public function block_repeated_row($context, array $blocks = array())
    {
        // line 221
        ob_start();
        // line 222
        echo "    ";
        $this->displayBlock("field_rows", $context, $blocks);
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 226
    public function block_field_row($context, array $blocks = array())
    {
        // line 227
        ob_start();
        // line 228
        echo "    <div>
        ";
        // line 229
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        if (isset($context["label"])) { $_label_ = $context["label"]; } else { $_label_ = null; }
        echo $this->env->getExtension('form')->renderLabel($_form_, ((array_key_exists("label", $context)) ? (_twig_default_filter($_label_, null)) : (null)));
        echo "
        ";
        // line 230
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo $this->env->getExtension('form')->renderErrors($_form_);
        echo "
        ";
        // line 231
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo $this->env->getExtension('form')->renderWidget($_form_);
        echo "
    </div>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 236
    public function block_hidden_row($context, array $blocks = array())
    {
        // line 237
        echo "    ";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo $this->env->getExtension('form')->renderWidget($_form_);
        echo "
";
    }

    // line 242
    public function block_field_enctype($context, array $blocks = array())
    {
        // line 243
        ob_start();
        // line 244
        echo "    ";
        if (isset($context["multipart"])) { $_multipart_ = $context["multipart"]; } else { $_multipart_ = null; }
        if ($_multipart_) {
            echo "enctype=\"multipart/form-data\"";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 248
    public function block_field_errors($context, array $blocks = array())
    {
        // line 249
        ob_start();
        // line 250
        echo "    ";
        if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
        if ((twig_length_filter($this->env, $_errors_) > 0)) {
            // line 251
            echo "    <ul>
        ";
            // line 252
            if (isset($context["errors"])) { $_errors_ = $context["errors"]; } else { $_errors_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_errors_);
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 253
                echo "            <li>";
                if (isset($context["error"])) { $_error_ = $context["error"]; } else { $_error_ = null; }
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($_error_, "messageTemplate"), $this->getAttribute($_error_, "messageParameters"), "validators"), "html", null, true);
                echo "</li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 255
            echo "    </ul>
    ";
        }
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 260
    public function block_field_rest($context, array $blocks = array())
    {
        // line 261
        ob_start();
        // line 262
        echo "    ";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_form_);
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 263
            echo "        ";
            if (isset($context["child"])) { $_child_ = $context["child"]; } else { $_child_ = null; }
            if ((!$this->getAttribute($_child_, "rendered"))) {
                // line 264
                echo "            ";
                if (isset($context["child"])) { $_child_ = $context["child"]; } else { $_child_ = null; }
                echo $this->env->getExtension('form')->renderRow($_child_);
                echo "
        ";
            }
            // line 266
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 272
    public function block_field_rows($context, array $blocks = array())
    {
        // line 273
        ob_start();
        // line 274
        echo "    ";
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo $this->env->getExtension('form')->renderErrors($_form_);
        echo "
    ";
        // line 275
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_form_);
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 276
            echo "        ";
            if (isset($context["child"])) { $_child_ = $context["child"]; } else { $_child_ = null; }
            echo $this->env->getExtension('form')->renderRow($_child_);
            echo "
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 281
    public function block_widget_attributes($context, array $blocks = array())
    {
        // line 282
        ob_start();
        // line 283
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
        // line 284
        echo "    ";
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

    // line 288
    public function block_widget_container_attributes($context, array $blocks = array())
    {
        // line 289
        ob_start();
        // line 290
        echo "    id=\"";
        if (isset($context["id"])) { $_id_ = $context["id"]; } else { $_id_ = null; }
        echo twig_escape_filter($this->env, $_id_, "html", null, true);
        echo "\"
    ";
        // line 291
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
        return "form_div_layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  1094 => 291,  1088 => 290,  1086 => 289,  1083 => 288,  1064 => 284,  1034 => 283,  1032 => 282,  1029 => 281,  1016 => 276,  1011 => 275,  1005 => 274,  1003 => 273,  1000 => 272,  991 => 266,  984 => 264,  980 => 263,  974 => 262,  972 => 261,  969 => 260,  962 => 255,  952 => 253,  947 => 252,  944 => 251,  940 => 250,  938 => 249,  935 => 248,  926 => 244,  924 => 243,  921 => 242,  913 => 237,  910 => 236,  901 => 231,  896 => 230,  890 => 229,  887 => 228,  885 => 227,  882 => 226,  874 => 222,  872 => 221,  869 => 220,  861 => 214,  859 => 213,  856 => 212,  848 => 208,  843 => 207,  841 => 206,  838 => 205,  813 => 201,  810 => 200,  806 => 199,  802 => 198,  800 => 197,  797 => 196,  789 => 190,  785 => 189,  783 => 188,  780 => 187,  773 => 184,  769 => 183,  766 => 182,  758 => 178,  754 => 177,  752 => 176,  749 => 175,  730 => 171,  726 => 170,  724 => 169,  721 => 168,  713 => 164,  709 => 163,  707 => 162,  704 => 161,  696 => 157,  692 => 156,  690 => 155,  687 => 154,  679 => 150,  675 => 149,  673 => 148,  670 => 147,  661 => 143,  659 => 142,  656 => 141,  648 => 137,  644 => 136,  642 => 135,  639 => 134,  631 => 130,  627 => 129,  625 => 128,  623 => 127,  620 => 126,  613 => 121,  601 => 120,  596 => 119,  590 => 117,  586 => 116,  584 => 115,  581 => 114,  573 => 108,  569 => 104,  564 => 103,  558 => 101,  554 => 100,  552 => 99,  549 => 98,  539 => 92,  534 => 91,  529 => 90,  524 => 89,  519 => 88,  513 => 86,  509 => 85,  507 => 84,  504 => 83,  486 => 79,  484 => 78,  481 => 77,  463 => 73,  461 => 72,  458 => 71,  448 => 65,  444 => 64,  441 => 63,  434 => 61,  430 => 60,  425 => 59,  421 => 58,  417 => 57,  410 => 55,  407 => 54,  398 => 53,  394 => 51,  385 => 49,  379 => 48,  374 => 47,  369 => 46,  365 => 45,  363 => 44,  360 => 43,  351 => 39,  335 => 37,  331 => 35,  312 => 33,  307 => 32,  301 => 31,  297 => 30,  291 => 29,  289 => 28,  286 => 27,  275 => 23,  273 => 22,  270 => 21,  262 => 17,  259 => 16,  254 => 15,  251 => 14,  249 => 13,  246 => 12,  237 => 7,  233 => 6,  228 => 5,  226 => 4,  223 => 3,  219 => 288,  216 => 287,  214 => 281,  211 => 280,  209 => 272,  206 => 271,  203 => 269,  201 => 260,  198 => 259,  196 => 248,  193 => 247,  191 => 242,  185 => 239,  183 => 236,  178 => 226,  175 => 225,  173 => 220,  170 => 219,  165 => 212,  160 => 205,  155 => 196,  149 => 193,  144 => 186,  139 => 181,  137 => 175,  134 => 174,  132 => 168,  127 => 161,  122 => 154,  119 => 153,  117 => 147,  114 => 146,  112 => 141,  109 => 140,  107 => 134,  104 => 133,  102 => 126,  99 => 125,  97 => 114,  94 => 113,  92 => 98,  89 => 97,  87 => 83,  84 => 82,  77 => 71,  74 => 70,  72 => 43,  69 => 42,  67 => 27,  59 => 20,  57 => 12,  49 => 2,  91 => 33,  79 => 76,  66 => 23,  64 => 26,  54 => 11,  32 => 9,  22 => 4,  17 => 1,  188 => 241,  186 => 62,  180 => 235,  177 => 59,  172 => 52,  167 => 217,  162 => 211,  157 => 204,  152 => 195,  147 => 187,  142 => 182,  135 => 66,  131 => 65,  129 => 167,  126 => 58,  124 => 160,  118 => 53,  115 => 52,  113 => 51,  98 => 41,  96 => 34,  88 => 34,  86 => 32,  82 => 77,  80 => 30,  75 => 27,  73 => 26,  68 => 23,  65 => 22,  62 => 21,  60 => 20,  55 => 17,  52 => 3,  50 => 14,  43 => 11,  37 => 8,  29 => 8,  27 => 2,  25 => 1,  40 => 7,  34 => 6,  31 => 4,  28 => 4,  23 => 1,);
    }
}
