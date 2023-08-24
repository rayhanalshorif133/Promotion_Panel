<?php

namespace App\Http\Controllers;

use App\Models\PostBackReceivedLog;
use App\Models\PostBackSentLog;
use Yajra\DataTables\Facades\DataTables;

class PostBackController extends Controller
{
    // sendLogs
    public function sendLogs()
    {
        // ajax request
        if (request()->ajax()) {
            $model = PostBackSentLog::query()->with(['operator', 'service'])
                ->orderBy('id', 'desc');
            return DataTables::eloquent($model)
                ->addColumn('DT_RowIndex', function () {
                    static $index = 1;
                    return $index++;
                })
                ->addColumn('service_name', function (PostBackSentLog $log) {
                    return $log->service->name;
                })
                ->addColumn('operator_name', function (PostBackSentLog $log) {
                    return $log->operator->name;
                })
                ->addColumn('sent_at', function (PostBackSentLog $log) {
                    return date('d-M-Y H:i:s a', strtotime($log->sent_at));
                })
                ->toJson();
        }
        return view('post_back.sent-logs');
    }

    // receivedLogs
    public function receivedLogs()
    {
        // ajax request
        if (request()->ajax()) {
            $model = PostBackReceivedLog::query()->with(['operator', 'service'])
                ->orderBy('id', 'desc');
            return DataTables::eloquent($model)
                ->addColumn('DT_RowIndex', function () {
                    static $index = 1;
                    return $index++;
                })
                ->addColumn('service_name', function (PostBackReceivedLog $log) {
                    return $log->service->name;
                })
                ->addColumn('operator_name', function (PostBackReceivedLog $log) {
                    return $log->operator->name;
                })
                ->addColumn('received_at', function (PostBackReceivedLog $log) {
                    return date('d-M-Y H:i:s a', strtotime($log->received_at));
                })
                ->toJson();
        }
        return view('post_back.received-logs');
    }
}
