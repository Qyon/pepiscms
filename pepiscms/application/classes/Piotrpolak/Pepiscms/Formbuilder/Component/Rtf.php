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
 * Rtf
 *
 * @since 1.0.0
 */
class Rtf extends AbstractComponent
{
    private $isFull = FALSE;

    /**
     * Rtf constructor.
     * @param bool $isFull
     */
    public function __construct($isFull = FALSE)
    {
        $this->isFull = $isFull;
    }


    /**
     * @inheritDoc
     */
    public function getComponentId()
    {
        if ($this->isFull) {
            return \FormBuilder::RTF_FULL;
        }

        return \FormBuilder::RTF;
    }

    /**
     * @inheritDoc
     */
    public function renderComponent($field, $valueEscaped, &$object, $extra_css_classes)
    {
        \CI_CONTROLLER::get_instance()->load->library('RTFEditor');
        \CI_CONTROLLER::get_instance()->rtfeditor->setupDefaultConfig();
        if ($this->isFull) {
            \CI_CONTROLLER::get_instance()->rtfeditor->setFull();
        }

        if (isset($field['options']['rtf'])) {
            foreach ($field['options']['rtf'] as $option_key => $option_value) {
                \CI_CONTROLLER::get_instance()->rtfeditor->setConfig($option_key, $option_value);
            }
        }

        // FIXME Set user defined default value
        return \CI_CONTROLLER::get_instance()->rtfeditor->generate(htmlspecialchars_decode($valueEscaped), 500, $field['field']);
    }
}