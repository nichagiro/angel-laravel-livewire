<?php

namespace App\Policies;

use App\Models\User;
use App\Models\blog;
use Illuminate\Auth\Access\HandlesAuthorization;

class blogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\blog  $blog
     * @return mixed
     */
    public function view(User $user, blog $blog)
    {
        
        if($user){

            return true;

        }
        else {

            return false;

        }

    }

  
    public function update(User $user, blog $blog)
    {
        if ($blog->users_id == $user->id) {
            return true;
        } 
        
        else {
            return false;
        }
    }

    public function delete(User $user, blog $blog)
    {
        if ($blog->users_id == $user->id) {
            return true;
        } 
        
        else {
            return false;
        }

    }

}
