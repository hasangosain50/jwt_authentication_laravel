<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Mail\ContactMail2;
use App\Models\Contact;
class ContactController extends Controller
{
public function Contactmail(Request $request){
    $contact=new Contact;
    $contact->name=$request->name;
    $contact->email=$request->email;
    $contact->contact_no=$request->contact_no;
    $contact->subject=$request->subject;
    $contact->message=$request->message;
    $result=$contact->save(); 
     if($result){
  
    $details=[
        'title'=>'Mail from DaleyMarket',
        'body'=>'Your response has been submitted.</br>
                 Thanks for contacting us.'
    ];
    $details2=[
        'title'=>'Mail from '.$contact->name,
        'body'=>'Username= '.$contact->name.' Email= '.$contact->email.' Contact = '.$contact->contact_no.' Subject = '.$contact->subject. ' Message ='.$contact->message 
    ];
    Mail::to($contact->email)->send(new ContactMail($details));
    Mail::to('karkidilip34@gmail.com')->send(new ContactMail2($details2));
            return "mail sent";
    }
}
}
