<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardStatus extends Model
{
    use HasFactory;

    protected $table = 'dashboard_status';

    protected $fillable = [
        'id',
        'title',
    ];
}
