<?php

namespace App\Policies;

use App\User;
use App\Expense;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpensePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the expense.
     *
     * @param  App\User  $user
     * @param  App\Expense  $expense
     * @return mixed
     */
    public function view(User $user, Expense $expense)
    {
        return $user->id == $expense->user_id;
    }

    /**
     * Determine whether the user can create expenses.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the expense.
     *
     * @param  App\User  $user
     * @param  App\Expense  $expense
     * @return mixed
     */
    public function update(User $user, Expense $expense)
    {
        return $user->id == $expense->user_id;
    }

    /**
     * Determine whether the user can delete the expense.
     *
     * @param  App\User  $user
     * @param  App\Expense  $expense
     * @return mixed
     */
    public function delete(User $user, Expense $expense)
    {
        return $user->id == $expense->user_id;
    }
}
