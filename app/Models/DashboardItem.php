<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardItem extends Model
{
    use HasFactory;

    protected $table = 'dashboard_items';

    protected $fillable = [
        'id',
        'status_id',
        'title',
        'text',
    ];
}
