<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseApplicationModule extends Model
{
    public $table = 'license_application_modules';
    public $primaryKey = 'id';

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }
}
