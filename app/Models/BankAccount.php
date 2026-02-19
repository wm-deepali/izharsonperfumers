<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'ac_name',
        'ac_number',
        'bank_name',
        'ifsc_code',
        'bank_branch',
        'payment_image',
    ];
}
