<?php

namespace App\Observers;
use illuminate\Support\Str;
use App\Models\Department;
use App\User;
class DepartmentObserver
{
    /**
     * Handle the department "created" event.
     *
     * @param  \App\Models\Department  $department
     * @return void
     */
    public function creating(Department $department)
    {
        $user=User::findOrFail(auth()->user()->id);
        $roles=$user->roles()->get();
        foreach($roles as $role){
            if('Moderator'==$role->name || 'Administrator'==$role->name)
                $department->slug=Str::slug($department->name);
        }
    }

    /**
     * Handle the department "updated" event.
     *
     * @param  \App\Models\Department  $department
     * @return void
     */
    public function updating(Department $department)
    {
        $department->slug=Str::slug($department->name);  
    }

    /**
     * Handle the department "deleted" event.
     *
     * @param  \App\Models\Department  $department
     * @return void
     */
    public function deleted(Department $department)
    {
        //
    }

    /**
     * Handle the department "restored" event.
     *
     * @param  \App\Models\Department  $department
     * @return void
     */
    public function restored(Department $department)
    {
        //
    }

    /**
     * Handle the department "force deleted" event.
     *
     * @param  \App\Models\Department  $department
     * @return void
     */
    public function forceDeleted(Department $department)
    {
        //
    }
}
