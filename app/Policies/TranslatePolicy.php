<?php

namespace App\Policies;

use DB;
use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class TranslatePolicy
{
    use HandlesAuthorization;

    protected $index      = 29;
    protected $update     = 30;

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
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user)
    {
        return $this->getPermission($user , $this->update);
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
