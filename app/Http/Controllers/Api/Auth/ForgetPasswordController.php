<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\forgetPasswordEmail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

// use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{
    public function forget(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255'
        ]);

        $email = $request->email;
        // dd($email);
        if (User::where('email', $email)->doesntExist()) {
            return response(['message' => 'ไม่พบอีเมล์นี้ในระบบ'], 400);
        }

        // check email in password_reset table
        $resetRequest = DB::table('password_resets')->where('email', $email)->first();
        if ($resetRequest) {
            // check token expired?
            if ($resetRequest->created_at >= now()) {
                return response(['message' => 'เพิ่ง request เข้ามานิ, token ยังไม่แหมดอายุ, ไปดูอีเมล์ใหม่ไป๊']);
            } else {
                // delete currently expired request
                DB::table('password_resets')->where('email', $email)->delete();
                return response(['message' => 'request เข้ามาแล้วนิ, token ก็แหมดอายุ, งั้นไป request ใหม่นะ']);
            }
        } else {
            $token = Str::random(10);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now()->addHours(1)
            ]);

            // Mail::send('mail.password_reset', ['token' => $token], function ($message) use ($email) {
            //     $message->to($email);
            //     $message->subject('กำหนดรหัสผ่านใหม่');
            // });

            // send mail section
            Mail::to($email)->send(new forgetPasswordEmail());

            return response(['message' => 'กรุณาตรวจสอบอีเมล์ของคุณ'], 200);
            // return response(['message' => 'ยังไม่ได้ request นิ, งั้นยัดลง DB นะ']);
        }
    }
}
