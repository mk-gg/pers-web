<?php

namespace App\Policies;

use App\Models\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Account  $account
     * @return mixed
     */
    public function viewAny(Account $account)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Account  $account
     * @return mixed
     */
    public function view(Account $account, Account $accounts)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Account  $account
     * @return mixed
     */
    public function create_acc(Account $account)
    {
        //
        return $account->account_type == 'administrator';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Account  $account
     * @return mixed
     */
    public function update(Account $account, Account $accounts)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Account  $account
     * @return mixed
     */
    public function delete(Account $account, Account $accounts)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Account  $account
     * @return mixed
     */
    public function restore(Account $account, Account $accounts)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Account  $account
     * @return mixed
     */
    public function forceDelete(Account $account, Account $accounts)
    {
        //
    }
}
