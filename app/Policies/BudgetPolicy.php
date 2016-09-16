<?php

namespace App\Policies;

use App\User;
use App\Budget;
use Illuminate\Auth\Access\HandlesAuthorization;

class BudgetPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param Budget $budget
     * @return bool
     */
    public function view(User $user, Budget $budget)
    {
        return $user->id == $budget->user_id;
    }

    /**
     * @param User $user
     * @param Budget $budget
     * @return bool
     */
    public function update(User $user, Budget $budget)
    {
        return $user->id == $budget->user_id;
    }

    /**
     * @param User $user
     * @param Budget $budget
     * @return bool
     */
    public function destroy(User $user, Budget $budget)
    {
        return $user->id == $budget->user_id;
    }
}
