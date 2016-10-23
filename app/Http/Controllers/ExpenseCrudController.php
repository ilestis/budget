<?php

namespace App\Http\Controllers;

use App\Filters\ExpenseFilter;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Expense;
use App\Http\Requests\Expense\StoreExpense;
use Illuminate\Support\Facades\DB;

class ExpenseCrudController extends Controller
{
    /**
     * @var Expense
     */
    protected $model;

    protected $filter;

    /**
     * ExpenseController constructor.
     * @param Expense $model
     */
    public function __construct(Expense $model, ExpenseFilter $filter)
    {
        $this->middleware('auth');
        $this->model = $model;
        $this->filter = $filter;
    }
    
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $expenses = $this->filter->filter($request->user()->expenses()->orderBy('day', 'DESC'));

        $filter = $this->filter;


        return view('expense.index', compact('expenses', 'filter'));
    }

    /**
     * @return mixed
     */
    public function create(Request $request)
    {
        $budgets = $request->user()->budgets()->orderBy('name')->pluck('name', 'id');
        return view('expense.create', compact('budgets'));
    }

    /**
     * @param Request $request
     * @param Recipe $recipe
     * @return mixed
     */
    public function show(Request $request, Expense $expense)
    {
        return view('expense.view', compact('expense'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(StoreExpense $request)
    {
        $expense = $request->user()->expenses()->create($request->all());

        if ($request->has('_back')) {
            return redirect($request->get('_back'));
        }
        
        return redirect('expense')->with('success', 'expense.validations.created');
    }

    /**
     * @param Request $request
     * @param Recipe $recipe
     * @return mixed
     */
    public function edit(Request $request, Expense $expense)
    {
        $budgets = $request->user()->budgets()->orderBy('name')->pluck('name', 'id');
        return view('expense.edit', compact('expense', 'budgets'));
    }

    /**
     * @param Request $request
     * @param Recipe $recipe
     * @return mixed
     */
    public function update(StoreExpense $request, Expense $expense)
    {
        $expense->fill($request->all())->save();
        return redirect('expense')->with('success', 'expense.validations.updated');
    }

    /**
     * @param Request $request
     * @param Recipe $recipe
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Request $request, Expense $expense)
    {
        $expense->delete();
        return redirect('expense')->with('success', 'expense.validations.deleted');
    }
}
