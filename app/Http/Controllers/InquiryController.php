<?php

namespace App\Http\Controllers;

use App\Mail\InquiryMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application inquiry.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = config('app.name').' - Contact Us';
        return view('inquiry.index', ['title' => $title, 'recaptcha' => true]);
    }

    public function store(Request $request)
    {
        $validation = [
            'company_name' => 'required|string|max:255',
            'department_section' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'family_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => ['nullable', 'regex:/\d|-|\+/u', 'max:255'],
            'inquiry' => 'required|string|max:300',
        ];
        Validator::make($request->all(), $validation)->validate();

        // Validate reCaptcha
        $client = new \GuzzleHttp\Client();
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $response = $client->request('POST', $url, [
            'form_params' => [
                'secret' => env('GRECAPTCHA_SECRET_KEY'),
                'response' => $request->grecaptcha,
            ]
        ]);
        $body = json_decode($response->getBody());
        if ($body->success === false || $body->score < 0.5) {
            // Invalid
            $request->session()->flash('grecaptcha_error', true);
            return redirect()->route('inquiry.index', app()->getLocale())->withInput();
        }

        Mail::to(json_decode(env('ADMIN_EMAILS'), true))->send(new InquiryMail($request));
        if (Mail::failures()) {
            $request->session()->flash('inquiry_error', true);
            return redirect()->route('inquiry.index', app()->getLocale())->withInput();
        } else {
            // Success
            $request->session()->flash('inquiry_success', true);
            return redirect()->route('inquiry.index', app()->getLocale());
        }
    }

}
