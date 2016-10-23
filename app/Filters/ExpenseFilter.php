<?php

namespace App\Filters;

use App\Filters\Types\Select;

class ExpenseFilter extends BaseFilter implements FilterInterface
{
    /**
     *
     */
    public function init()
    {
        $this->filters[] = (new Select('budget_id', $this->request))
            ->data($this->request->user()->budgets()->orderBy('name', 'ASC')->pluck('name', 'id'))
            ->label('expense.fields.budget');

        parent::init();
    }
}