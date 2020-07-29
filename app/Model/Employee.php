<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'company_id', 'email', 'phone'
    ];

    /**
     * Get the company associated with the employee.
     */
    public function company()
    {
        return $this->belongsTo('App\Model\Company');
    }
}
