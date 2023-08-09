<?php

namespace App\Http\Controllers;

use App\Models\PostBackReceivedLog;
use App\Models\PostBackSendLog;
use Illuminate\Http\Request;

class PostBackController extends Controller
{
    // sendLogs
    public function sendLogs()
    {
        $sendLogs = PostBackSendLog::all();
        return view('post_back.send-logs', compact('sendLogs'));
    }

    // receivedLogs
    public function receivedLogs()
    {
        $sendReceives = PostBackReceivedLog::all();
        return view('post_back.received-logs', compact('sendReceives'));
    }
}
