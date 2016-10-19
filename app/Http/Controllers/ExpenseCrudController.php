<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Expense;
use App\Budget;
use App\Http\Requests\Expense\StoreExpense;

class ExpenseCrudController extends Controller
{
    /**
     * @var Expense
     */
    protected $model;

    /**
     * ExpenseController constructor.
     * @param Expense $model
     */
    public function __construct(Expense $model)
    {
        $this->middleware('auth');
        $this->model = $model;
    }
    
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $expenses = $request->user()->expenses()->orderBy('amount', 'DESC')->paginate();
        return view('expense.index', compact('expenses'));
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
