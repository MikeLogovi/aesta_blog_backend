<?php

namespace App\Observers;
use illuminate\Support\Str;
use App\Models\Department;

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
        $department->slug=Str::slug($department->name);

        /*if(in_array('admin',auth()->user()->roles()->toArray()) || in_array('moderator',auth()->user()->roles()->toArray())){
        }*/

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
        /*if(in_array('admin',auth()->user()->roles()) || in_array('moderator',auth()->user()->roles())){
        }*/
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
