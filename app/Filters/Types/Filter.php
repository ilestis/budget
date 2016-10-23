<?php

namespace App\Filters\Types;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

abstract class Filter
{
    protected $data;

    protected $field;

    protected $defaultValue = '';

    protected $options = [];

    protected $request;

    protected $label;

    /**
     * Filter constructor.
     * @param $field
     * @param Request $request
     */
    public function __construct($field, Request $request)
    {
        $this->field = $field;
        $this->request = $request;
        return $this;
    }

    /**
     * @param array $values
     * @return $this
     */
    public function data($values = [])
    {
        $this->data = $values;
        return $this;
    }

    /**
     * @return $this
     */
    public function appendEmpty()
    {
        if ($this->data instanceof Collection) {
            $this->data->prepend('', 0);
        } else {
            array_prepend($this->data, '');
        }
        return $this;
    }

    /**
     * @param $label
     * @return $this
     */
    public function label($label)
    {
        $this->label = trans($label);
        return $this;
    }

    /**
     * @param null $value
     * @return $this
     */
    public function defaultValue($value = null)
    {
        $this->defaultValue = $value;
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function field($name = '')
    {
        $this->field = $name;
        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function options($options = [])
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return mixed
     */
    public function name()
    {
        return $this->field;
    }

    /**
     * @return mixed|string
     */
    public function value()
    {
        if ($this->request->has($this->field)) {
            return $this->request->get($this->field);
        } else {
            return $this->defaultValue;
        }
    }
}