<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignDetail extends Model
{
    use HasFactory;

    protected $table = 'campaign_details';

    protected $fillable = [
        'campaign_id',
        'operator_id',
        'service_id',
        'ratio',
        'url',
        'status'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
