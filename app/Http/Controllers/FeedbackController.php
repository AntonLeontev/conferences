<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Mail\FeedbackEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function __invoke(FeedbackRequest $request): JsonResponse
    {
        Mail::to(config('app.feedback_email'))->send(new FeedbackEmail($request->all()));

        return response()->json(['ok' => true]);
    }
}
