<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPlatform extends Model
{
    protected $primaryKey = 'iso';
    public $incrementing = false;

    use HasFactory;

    protected $fillable = [
        'name',
        'image'
    ];
}
