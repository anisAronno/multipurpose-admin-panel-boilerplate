<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Enums\AdministrativeRole;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasFactory;

    public function getCreatedAtAttribute($value)
    {
        if ($value !== null) {
            return  $this->attributes['created_at'] = Carbon::parse($value)->diffForHumans();
        }
    }

    protected $appends = array('isDeletable', 'isEditable');

    public function getIsDeletableAttribute($value)
    {
        $administrativeRole = AdministrativeRole::values();

        if (! in_array($this->id, $administrativeRole)) {
            return true;
        } else {
            return false;
        }
    }
    public function getIsEditableAttribute($value)
    {
        if ($this->id === 1) {
            return false;
        } else {
            return true;
        }
    }
}
