<?php

namespace App\Http\Controllers;

use App\Mail\sandEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController
{
    public function sandEmail()
    {
        //define variables
        $toEmail = 'fullstackdeveloper014@gmail.com';
        $subject = 'ExamInfoBlog - Sand Email';
        $message = "Welcome to ExamInfoBlog, we are glad you joined us, you can get latest jobs, results, admit card, answer key and notification";

        $response = Mail::to($toEmail)->queue(new sandEmail($message, $subject));

        return json_encode(['status' => 'success', 'message' => 'Email Send Successfully'], JSON_PRETTY_PRINT);
    }
}
