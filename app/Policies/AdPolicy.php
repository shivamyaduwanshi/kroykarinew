<?php

namespace App\Policies;

use DB;
use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class AdPolicy
{
    use HandlesAuthorization;

    protected $index      = 13;
    protected $reject     = 14;
    protected $approve     = 15;
    protected $delete     = 16;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function index(User $user)
    {  
        return $this->getPermission($user , $this->index);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function reject(User $user)
    {
        return $this->getPermission($user , $this->reject);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function approve(User $user)
    {
        return $this->getPermission($user , $this->approve);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user)
    {
        return $this->getPermission($user , $this->delete);
    }

    /**
     * Determine whether the user can change status the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function status(User $user)
    {
        return $this->getPermission($user , $this->status);
    }

    protected function getPermission($user,$p_id)
    {   
        $status = false;

        $permissions = DB::table('permission_role as p_role')
                             ->where('role_id' , '=' , $user->role_id)
                             ->where('permission_id' , '=' , $p_id)
                             ->count();

        if(!empty($permissions) && !is_null($permissions) && $permissions > 0){
            return true;
        }
     
        return $status;
    }
}
