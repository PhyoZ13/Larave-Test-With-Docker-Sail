<?php

namespace App\Http\Controllers;

use App\Http\Requests\InquiryStoreRequest;
use App\Mail\InquiryMail;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    public function create()
    {
        return view('inquiry.create');
    }

    public function store(InquiryStoreRequest $request)
    {
        $validated = $request->validated();

        // Send email to the entered address (auto-reply)
        Mail::to($validated['email'])->send(
            new InquiryMail($validated['name'], $validated['body'], 'お問い合わせ自動返信メール')
        );

        // Send email to inquiry@mail.test (admin notification)
        Mail::to('inquiry@mail.test')->send(
            new InquiryMail($validated['name'], $validated['body'], 'お問い合わせ管理者メール')
        );

        return redirect()->route('inquiry')->with('success', 'お問い合わせを送信しました。');
    }
}
