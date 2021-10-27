<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lead;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function contact()
    {
        return view('guest.contatti');

    }

    public function handleContactForm(Request $request) {
        $form_data = $request->all();
        $new_lead = new Lead();
        $new_lead->fill($form_data);
        $new_lead->save();

        Mail::to('account@mail.it')->send(new SendNewMail($new_lead));
        return redirect()->route('contatti.thank')->with('alert-type', 'success')->with('alert-message', $new_lead->name); 

    }

    public function thank() {
        return view('guest.thank'); 
    }

}
