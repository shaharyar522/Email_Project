<?php

namespace App\Http\Controllers;

use App\Mail\welcomeemail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmailController extends Controller
{

     public function sendEmail(){
        $toEmail = "webdevelopment185@gmail.com";
        $message = "hello wellcome";
        $subject = "wellcome";
        $details = [
             'name' => "shari kahna",
             'product'=> "software",
             'price' => 250
        ];

         $request = Mail::to($toEmail)->send(new welcomeemail($message, $subject,$details));

         dd($request);
     }
}
