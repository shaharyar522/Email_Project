<?php

namespace App\Http\Controllers;

use App\Mail\welcomeemail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmailController extends Controller
{

     public function sendEmail()
     {
          $toEmail = "webdevelopment185@gmail.com";
          $message = "hello wellcome";
          $subject = "wellcome";
          $details = [
               'name' => "shari kahna",
               'product' => "software",
               'price' => 250
          ];

          $request = Mail::to($toEmail)->send(new welcomeemail($message, $subject, $details));

          dd($request);
     }

     public function contactForm()
     {
          return view('contact-form');
     }

     public function sendContactEmail(Request $request)
     {
          $request->validate([
               'name'       => 'required|string|max:100',
               'email'      => 'required|email',
               'subject'    => 'required|string|max:150',
               'message'    => 'required|string',
               'attachment' => 'required|mimes:pdf,doc,docx,xls|max:2048', // fixed docx
          ]);

          $fileName = time() . "." . $request->file('attachment')->extension();

          $request->file('attachment')->move('uploads', $fileName);

          $adminEmail = "webdevelopment185@gmail.com";

          $responce = Mail::to($adminEmail)->send(new welcomeemail($request->all(), $fileName));

          if($responce){
               return  back()->with('success', "Thank You for contacting us.");
          } else {
               return back()->with('error', "Unable to submitted form, Please try agin");
          }

     }
}
