<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Expense\StoreExpenseRequest;
use App\Http\Requests\Expense\UpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use App\Services\ExpenseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function __construct(protected ExpenseService $expenses)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $expenses = $this->expenses->paginate($request->only(['search', 'category', 'per_page']));

        return response()->json(ExpenseResource::collection($expenses)->response()->getData(true));
    }

    public function store(StoreExpenseRequest $request): JsonResponse
    {
        $expense = $this->expenses->create($request->validated(), $request->user()->id);

        return response()->json(new ExpenseResource($expense), 201);
    }

    public function show(Expense $expense): JsonResponse
    {
        return response()->json(new ExpenseResource($expense));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense): JsonResponse
    {
        $this->expenses->update($expense, $request->validated());

        return response()->json(new ExpenseResource($expense));
    }

    public function destroy(Expense $expense): JsonResponse
    {
        $this->expenses->delete($expense);

        return response()->json(null, 204);
    }
}
