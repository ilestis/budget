<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Budget;
use App\Http\Requests\Budget\StoreBudget;

class BudgetCrudController extends Controller
{
    /**
     * @var Budget
     */
    protected $model;

    /**
     * BudgetController constructor.
     * @param Budget $model
     */
    public function __construct(Budget $model)
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
        $budgets = $request->user()->budgets()->paginate();
        return view('budget.index', compact('budgets'));
    }

    /**
     * @return mixed
     */
    public function create(Request $request)
    {
        return view('budget.create');
    }

    /**
     * @param Request $request
     * @param Recipe $recipe
     * @return mixed
     */
    public function show(Request $request, Budget $budget)
    {
        return view('budget.view', compact('budget'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(StoreBudget $request)
    {
        $budget = $request->user()->budgets()->create($request->all());
        return redirect('budget')->with('success', 'budget.validations.created');
    }

    /**
     * @param Request $request
     * @param Recipe $recipe
     * @return mixed
     */
    public function edit(Request $request, Budget $budget)
    {
        return view('budget.edit', compact('budget'));
    }

    /**
     * @param Request $request
     * @param Recipe $recipe
     * @return mixed
     */
    public function update(StoreBudget $request, Budget $budget)
    {
        $budget->fill($request->all())->save();
        return redirect('budget')->with('success', 'budget.validations.updated');
    }

    /**
     * @param Request $request
     * @param Recipe $recipe
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Request $request, Budget $budget)
    {
        $budget->delete();
        return redirect('budget')->with('success', 'budget.validations.deleted');
    }
}
