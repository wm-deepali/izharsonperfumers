<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookAppointment;
class BookAppointMentController extends Controller
{
    public function index(){
        $datas=BookAppointment::latest()->get();
         return view('admin.appointment-booking.appointment-booking',compact('datas')); 
    }
}
