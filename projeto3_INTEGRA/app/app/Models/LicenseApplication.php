<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseApplication extends Model
{
    public $table = 'license_applications';
    public $primaryKey = 'id';

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id', 'id');
    }

    public function modules()
    {
        return $this->hasMany(LicenseApplicationModule::class, 'license_application_id', 'id');
    }
}
