<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SendMail extends Controller
{
    public function index()
    {
        if (!Session::has('email')) {
            return redirect('/admin')->with('error', 'Please login to access this page.');
        }

        return view('Dashboard.send-mail');
    }

    public function MailSend(Request $request)
    {
        $message = [
            'mail_to.required' => 'Please Enter Sender Mail Address.',
            'mail_to.email' => 'Please Enter Valid Email Address.',
            'mail_subject.required' => 'Please Enter Mail Subject.',
            'mail_message.required' => 'Please Enter Mail Message.',
        ];
        $validator = Validator::make($request->all(), [
            'mail_to' => 'required|email',
            'mail_subject' => 'required',
            'mail_message' => 'required',
        ], $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = [
            'mail_to' => $request->input('mail_to'),
            'mail_subject' => $request->input('mail_subject'),
            'mail_message' => $request->input('mail_message'),
        ];

        Mail::send('Dashboard.Mail-Structure', $data, function ($message) use ($data) {
            $message->to($data['mail_to']);
            $message->subject($data['mail_subject']);
        });

        return response()->json([
            'message' => 'Mail Send Successfully!',
        ], 200);

    }
}
