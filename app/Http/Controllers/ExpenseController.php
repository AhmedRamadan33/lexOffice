<?php

namespace App\Http\Controllers;

use App\Http\Requests\Expense\StoreExpenseRequest;
use App\Http\Requests\Expense\UpdateExpenseRequest;
use App\Models\Expense;
use App\Services\ExpenseService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExpenseController extends Controller
{
    public function __construct(protected ExpenseService $expenses)
    {
    }

    public function index(Request $request): View
    {
        $expenses = $this->expenses->paginate($request->only(['search', 'category', 'per_page']));

        return view('expenses.index', compact('expenses'));
    }

    public function create(): View
    {
        return view('expenses.create');
    }

    public function store(StoreExpenseRequest $request): RedirectResponse
    {
        $this->expenses->create($request->validated(), $request->user()->id);

        return redirect()->route('expenses.index')->with('success', __('app.messages.created'));
    }

    public function edit(Expense $expense): View
    {
        return view('expenses.edit', compact('expense'));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense): RedirectResponse
    {
        $this->expenses->update($expense, $request->validated());

        return redirect()->route('expenses.index')->with('success', __('app.messages.updated'));
    }

    public function destroy(Expense $expense): RedirectResponse
    {
        $this->expenses->delete($expense);

        return redirect()->route('expenses.index')->with('success', __('app.messages.deleted'));
    }
}
