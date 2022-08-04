<?php

namespace App\Http\Controllers;

use App\Models\ProgramModel;
use App\Models\RegistrationModel;
use Illuminate\Http\Request;
use App\Mail\HelloEmail;
use App\Models\EmailTracker;
use Illuminate\Support\Facades\Mail;


class MainController extends Controller
{

    public function index(Request $request)
    {
        // dd($request->slug);
        $program = ProgramModel::where('slug', $request->slug)->where('status', 1)->first();

        if (!$program) {
            return abort(404, 'Page not found.');
        }

        return view('register', ['program' => $program]);
    }

    public function register(Request $request)
    {

        if (empty($request->program_id) || empty($request->name) || empty($request->email) || empty($request->phone)) {
            return redirect()->back()->with('message', 'All fields are required');
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('message', 'Invalid Email format');
        }

        if (!preg_match("/^[a-zA-Z-' ]*$/", $request->name)) {
            return redirect()->back()->with('message', 'Only letters and white space allowed in full name');
        }
        if (!preg_match("/(^(\+88|88)?(01){1}[3456789]{1}(\d){8})$/", $request->phone)) {
            return redirect()->back()->with('message', 'Only Bangladeshi phone number is allowed');
        }


        $program = ProgramModel::where('slug', $request->programSlug)->where('status', 1)->where('id', $request->program_id)->first();

        if (!$program) {
            return abort(403, 'Who are you, Please');
        }



        $checkEntry = RegistrationModel::where('program_id', $program->id)->where('email', $request->email)->first();


        if ($checkEntry) {
            return redirect()->back()->with('message', 'You are already registered');
        }

        $checkPhone = RegistrationModel::where('program_id', $program->id)->where('phone', $request->phone)->first();


        if ($checkPhone) {
            return redirect()->back()->with('message', 'This phone is already registered');
        } else {
            $newNumber = '';

            if ($request->phone[0] == '0') {
                $newNumber = '88' . $request->phone;
            } else {
                $strToReplace = '';
                $newNumber =  $strToReplace . substr($request->phone, 2);
            }

            if (RegistrationModel::where('program_id', $program->id)->where('phone', $newNumber)->first()) {
                return redirect()->back()->with('message', 'This phone is already registered');
            }
        }



        $newRow = new RegistrationModel();
        $newRow->program_id = $request->program_id;
        $newRow->name = ucwords($request->name);
        $newRow->email = strtolower($request->email);
        $newRow->phone = $request->phone;
        $newRow->note = $request->note;

        $newRow->save();



        $newRow->viewkey = md5($newRow->id) . mt_rand(100, 9999);
        $newRow->save();

        $this->sendMail($newRow->email,  [
            'name' => $newRow->name,
            'email' => $newRow->email,
            'phone' => $newRow->phone,
            'program' => $program
        ]);

        // $url = "/success/".$request->name. "/".$request->email."/". str_replace(" ", '-',$program->title);
        $url = "/success/" . $newRow->viewkey;

        return redirect()->to($url);
    }



    public function success(Request $request)
    {

        if (!$request->viewkey) {
            return abort(404);
        }

        $registrationInfo = RegistrationModel::where('viewkey', $request->viewkey)->first();

        if (!$registrationInfo) {
            return abort(403);
        }

        return view('success', [
            'registrationInfo' => $registrationInfo
        ]);
    }


    public function sendMail($to, $data)
    {
        $mailStatus = Mail::to($to)->send(new HelloEmail($data));


        $emailTracker = new EmailTracker();
        $emailTracker->email = $to;

        if (Mail::failures() != 1) {
            $emailTracker->status = 0;
        }
        $emailTracker->status = 1;
        $emailTracker->save();
    }



    // public function sendSMS()
    // {
    //     // username, password, sid provided by sslwireless
    //     $SslWirelessSms = new SslWirelessSms('username','password', 'sid');
    //     // You can change the api url if needed. i.e.
    //     // $SslWirelessSms->setUrl('new_url');
    //     $output = $SslWirelessSms->send('123456789','This is a test message.');

    //     dd($output);
    // }
}
