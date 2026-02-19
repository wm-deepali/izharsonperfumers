<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPasswordActivity extends Model
{
    use HasFactory;
    protected $table="user_password_activity";
    protected $fillable=[
        'user_id','ip_address','password_update_type','location'
        ];
}
