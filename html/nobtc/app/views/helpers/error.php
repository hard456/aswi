<?php
/*
 * Created on 11.7.2007
 * Jaroslav Bauml
 */

class ErrorHelper extends Helper
{
    function showMessage($target)
    {
        list($model, $field) = explode('/', $target);

        if (isset($this->validationErrors[$model][$field]))
        {
            return sprintf('<div class="error_message">%s</div>',
                              $this->validationErrors[$model][$field]);
        }
        else
        {
            return null;
        }
    }
}