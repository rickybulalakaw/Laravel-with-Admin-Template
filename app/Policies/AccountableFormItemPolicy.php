<?php

namespace App\Policies;

use App\Models\AccountableForm;
use App\Models\AccountableFormItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AccountableFormItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AccountableFormItem $accountableFormItem): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, AccountableForm $accountableForm): bool
    {
        return $user->id === $accountableForm->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AccountableFormItem $accountableFormItem): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AccountableForm $accountableForm): bool
    {
        return $user->id === $accountableForm->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AccountableFormItem $accountableFormItem): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AccountableFormItem $accountableFormItem): bool
    {
        //
    }
}
