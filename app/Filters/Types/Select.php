<?php

namespace App\Filters\Types;

use App\Filters\Types\FilterInterface;
use Collective\Html\FormFacade;

class Select extends Filter implements FilterInterface
{
    public function render()
    {
        $render = '<div class="form-group">';
        $render .= FormFacade::label($this->field, $this->label);
        $render .= FormFacade::select($this->field, $this->data->prepend($this->label, 0), $this->value(), $this->options);
        $render .= '</div>';

        return $render;
    }
}