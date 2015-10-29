<?php

namespace Mitul\Generator;

use Illuminate\Support\Str;

class FormFieldsGenerator
{
    public static function generateLabel($field)
    {
        $label = Str::title(str_replace('_', ' ', $field['fieldName']));

        $template = "{!! Form::label('\$FIELD_NAME\$', '\$FIELD_NAME_TITLE\$', ['class' => 'col-lg-2 control-label']) !!}";

        $template = str_replace('$FIELD_NAME_TITLE$', $label, $template);
        $template = str_replace('$FIELD_NAME$', $field['fieldName'], $template);

        return $template;
    }

    private static function replaceFieldVars($textField, $field)
    {
        $label = Str::title(str_replace('_', ' ', $field['fieldName']));

        $textField = str_replace('$FIELD_NAME$', $field['fieldName'], $textField);
        $textField = str_replace('$FIELD_NAME_TITLE$', $label, $textField);
        $textField = str_replace('$FIELD_INPUT$', $textField, $textField);

        return $textField;
    }

    public static function text($templateData, $field)
    {
        $fieldLabel = self::generateLabel($field);

        $textField = "{!! Form::text('\$FIELD_NAME\$', null, ['class' => 'form-control', 'placeholder' => '\$FIELD_NAME_TITLE\$']) !!}";

        $templateData = str_replace('$FIELD_LABEL$', $fieldLabel, $templateData);
        
        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function textarea($templateData, $field)
    {
        $fieldLabel = self::generateLabel($field);

        $textareaField = "{!! Form::textarea('\$FIELD_NAME\$', null, ['class' => 'form-control', 'placeholder' => '\$FIELD_NAME_TITLE\$']) !!}";

        $templateData = str_replace('$FIELD_LABEL$', $fieldLabel, $templateData);

        $templateData = str_replace('$FIELD_INPUT$', $textareaField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function password($templateData, $field)
    {
        $fieldLabel = self::generateLabel($field);

        $textField = "{!! Form::password('\$FIELD_NAME\$', ['class' => 'form-control', 'placeholder' => '\$FIELD_NAME_TITLE\$']) !!}";

        $templateData = str_replace('$FIELD_LABEL$', $fieldLabel, $templateData);

        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function email($templateData, $field)
    {
        $fieldLabel = self::generateLabel($field);

        $textField = "{!! Form::email('\$FIELD_NAME\$', null, ['class' => 'form-control', 'placeholder' => '\$FIELD_NAME_TITLE\$']) !!}";

        $templateData = str_replace('$FIELD_LABEL$', $fieldLabel, $templateData);

        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function file($templateData, $field)
    {
        $fieldLabel = self::generateLabel($field);

        $textField = "{!! Form::file('\$FIELD_NAME\$', ['class' => 'form-control']) !!}";

        $templateData = str_replace('$FIELD_LABEL$', $fieldLabel, $templateData);

        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function checkbox($templateData, $field)
    {
        $fieldLabel = self::generateLabel($field);
        
        $textField = "<div class=\"checkbox\">\n";
        $textField .= "\t\t<label>";

        $textField .= "{!! Form::checkbox('\$FIELD_NAME\$', 1, true) !!}";
        $textField .= '$FIELD_NAME_TITLE$';

        $textField .= '</label>';
        $textField .= "\n\t</div>";

        $templateData = str_replace('$FIELD_LABEL$', $fieldLabel, $templateData);

        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function radio($templateData, $field)
    {
        $fieldLabel = self::generateLabel($field);
        
        $textField = '';

        if (count($field['typeOptions']) > 0) {
            $arr = explode(',', $field['typeOptions']);

            foreach ($arr as $item) {
                $label = Str::title(str_replace('_', ' ', $item));

                $textField .= "\n\t<div class=\"radio-inline\">";
                $textField .= "\n\t\t<label>";

                $textField .= "\n\t\t\t{!! Form::radio('gender', '".$item."', null) !!} $label";

                $textField .= "\n\t\t</label>";
                $textField .= "\n\t</div>";
            }
        }

        $templateData = str_replace('$FIELD_LABEL$', $fieldLabel, $templateData);

        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function number($templateData, $field)
    {
        $fieldLabel = self::generateLabel($field);

        $textField = "{!! Form::number('\$FIELD_NAME\$', null, ['class' => 'form-control', 'placeholder' => '\$FIELD_NAME_TITLE\$']) !!}";

        $templateData = str_replace('$FIELD_LABEL$', $fieldLabel, $templateData);

        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function date($templateData, $field)
    {
        $fieldLabel = self::generateLabel($field);

        $textField = "{!! Form::date('\$FIELD_NAME\$', null, ['class' => 'form-control', 'placeholder' => '\$FIELD_NAME_TITLE\$']) !!}";

        $templateData = str_replace('$FIELD_LABEL$', $fieldLabel, $templateData);

        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }

    public static function select($templateData, $field)
    {
        $fieldLabel = self::generateLabel($field);

        $textField = "{!! Form::select('\$FIELD_NAME\$', \$INPUT_ARR\$, null, ['class' => 'form-control', 'placeholder' => '\$FIELD_NAME_TITLE\$...']) !!}";
        $textField = str_replace('$FIELD_NAME$', $field['fieldName'], $textField);

        if (count($field['typeOptions']) > 0) {
            $arr = explode(',', $field['typeOptions']);
            $inputArr = '[';
            foreach ($arr as $item) {
                $inputArr .= " '$item' => '$item',";
            }

            $inputArr = substr($inputArr, 0, strlen($inputArr) - 1);

            $inputArr .= ' ]';

            $textField = str_replace('$INPUT_ARR$', $inputArr, $textField);
        } else {
            $textField = str_replace('$INPUT_ARR$', '[]', $textField);
        }

        $templateData = str_replace('$FIELD_LABEL$', $fieldLabel, $templateData);

        $templateData = str_replace('$FIELD_INPUT$', $textField, $templateData);

        $templateData = self::replaceFieldVars($templateData, $field);

        return $templateData;
    }
}
