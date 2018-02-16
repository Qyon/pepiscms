<?php

/**
 * PepisCMS
 *
 * Simple content management system
 *
 * @package             PepisCMS
 * @author              Piotr Polak
 * @copyright           Copyright (c) 2007-2018, Piotr Polak
 * @license             See license.txt
 * @link                http://www.polak.ro/
 */

namespace Piotrpolak\Pepiscms\Formbuilder\Component;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TextfieldAutocomplete
 *
 * @since 1.0.0
 */
class TextfieldAutocomplete extends AbstractComponent
{
    /**
     * @inheritDoc
     */
    public function getComponentId()
    {
        return \FormBuilder::TEXTFIELD_AUTOCOMPLETE;
    }

    /**
     * @inheritDoc
     */
    public function shouldAttachAdditionalJavaScript()
    {
        return TRUE;
    }

    /**
     * @inheritDoc
     */
    public function renderComponent($field, $valueEscaped, &$object, $extra_css_classes)
    {
        return '<input type="text" name="' . $field['field'] . '" id="' . $field['field'] . '" value="' . $valueEscaped .
            '" class="text' . $extra_css_classes . '" />' .
            '<script type="text/javascript">$("#' . $field['field'] . '").autocomplete({source: "' . $field['autocomplete_source'] . '", minLength: 1});</script>';
    }
}