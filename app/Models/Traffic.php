<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    use HasFactory;

    protected $table = 'traffic';

    protected $fillable = [
        'campaign_id',
        'service_id',
        'operator_id',
        'clicked_id',
        'others',
        'received_at',
        'callback_received_status',
        'callback_sent_status',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    
}
