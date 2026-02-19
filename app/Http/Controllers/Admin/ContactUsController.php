<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $contact_uses = ContactUs::latest()->get();
        return view('admin.contact-us.index')->with([
            'contact_uses' => $contact_uses
        ]);
    }
    public function emailsubscriber()
    {
        $subscriber = Subscriber::latest()->get();
        return view('admin.contact-us.subscriber')->with([
            'subscriber' => $subscriber
        ]);
    }
    
public function deleteemailsubscriber($id)
    {
        try {
            $contact_us = Subscriber::findOrFail($id);
            $contact_us->delete();
            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }
    public function destroy($id)
    {
        try {
            $contact_us = ContactUs::findOrFail($id);
            $contact_us->delete();
            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }
}
