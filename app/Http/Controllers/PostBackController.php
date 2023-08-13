<?php

namespace App\Http\Controllers;

use App\Models\PostBackReceivedLog;
use App\Models\PostBackSentLog;
use Illuminate\Http\Request;

class PostBackController extends Controller
{
    // sendLogs
    public function sendLogs()
    {
        $sentLogs = PostBackSentLog::select()
            ->with(['operator','service'])
            ->orderBy('id', 'desc')
            ->get();
        return view('post_back.sent-logs', compact('sentLogs'));
    }

    // receivedLogs
    public function receivedLogs()
    {
        $sendReceives = PostBackReceivedLog::select()
        ->with(['operator','service'])
        ->orderBy('id', 'desc')
        ->get();
        return view('post_back.received-logs', compact('sendReceives'));
    }
}
