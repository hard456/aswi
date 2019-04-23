<?php


namespace App\Utils;


/**
 * Slouží k vytváření formulářů s bootstrapovým vzhledem
 *
 * @package App\Utils
 */
class Form extends \Nette\Application\UI\Form
{
    public function __construct($name = null)
    {
        parent::__construct($name);

        $renderer = $this->getRenderer();
        $renderer->wrappers['controls']['container'] = null;
        $renderer->wrappers['pair']['container'] = 'div class="row mt-2"';
        $renderer->wrappers['pair']['.error'] = 'has-error';
        $renderer->wrappers['control']['container'] = 'div class=col-8';
        $renderer->wrappers['label']['container'] = 'div class="col-4 control-label"';
        $renderer->wrappers['control']['description'] = 'span class=help-block';
        $renderer->wrappers['error']['container'] = 'div class="alert alert-danger"';
        $this->getElementPrototype()->class('form-horizontal');

    }

    public function addText($name, $label = null, $cols = null, $maxLength = null)
    {
        return parent::addText($name, $label, $cols, $maxLength)->setHtmlAttribute('class', 'form-control');
    }

    public function addSelect($name, $label = null, array $items = null, $size = null)
    {
        return parent::addSelect($name, $label, $items, $size)->setHtmlAttribute('class', 'form-control');
    }

    public function addPassword($name, $label = null, $cols = null, $maxLength = null)
    {
        return parent::addPassword($name, $label, $cols, $maxLength)->setHtmlAttribute('class', 'form-control');
    }

    public function addEmail($name, $label = null)
    {
        return parent::addEmail($name, $label)->setHtmlAttribute('class', 'form-control');
    }

    public function addTextArea($name, $label = null, $cols = null, $rows = null)
    {
        return parent::addTextArea($name, $label, $cols, $rows)->setHtmlAttribute('class', 'form-control');
    }

    public function addUpload($name, $label = null, $multiple = false)
    {
        return parent::addUpload($name, $label, $multiple)->setHtmlAttribute('class', 'form-control');
    }

    public function addInteger($name, $label = null)
    {
        return parent::addInteger($name, $label)->setHtmlAttribute('class', 'form-control');
    }

    protected function beforeRender()
    {
        parent::beforeRender();

        foreach ($this->getControls() as $control)
        {
            $type = $control->getOption('type');
            if ($type === 'button')
            {
                $control->getControlPrototype()->addClass('btn btn-success form-control');
            }
        }
    }
}