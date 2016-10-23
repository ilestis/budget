<?php

namespace App\Filters;

use Collective\Html\FormFacade;
use Illuminate\Http\Request;

abstract class BaseFilter
{
    protected $filters = [];

    protected $request;

    protected $initiated = false;

    /**
     * BaseFilter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     *
     */
    public function init()
    {
        $this->initiated = true;
    }

    /**
     * @return string
     */
    public function render()
    {
        if (!$this->initiated) {
            $this->init();
        }

        $return = FormFacade::open(['method' => 'GET', 'class' => 'form-inline']);
        foreach ($this->filters as $filter) {
            $return .= $filter->render();
        }

        $return .= FormFacade::submit('Filter', ['class' => 'btn btn-default']);
        $return .= FormFacade::close();


        return $return;
    }

    /**
     * @return array
     */
    public function values()
    {
        if (!$this->initiated) {
            $this->init();
        }

        $values = [];
        foreach ($this->filters as $filter) {
            if (!empty($filter->value())) {
                $values[$filter->name()] = $filter->value();
            }
        }

        return $values;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function filter($query)
    {
        foreach ($this->values() as $key => $value) {
            $query->where($key, $value);
        }
        return $query->paginate();
    }
}