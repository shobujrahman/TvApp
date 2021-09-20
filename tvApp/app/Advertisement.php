<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'admob_inter',
        'admob_native',
        'admob_banner',
        'admob_reward',
        'fb_inter',
        'fb_native',
        'fb_banner',
        'fb_reward',       
        'startup_inter',            
        'startup_banner',       
        'native_ads',       
        'industrial_interval',       
        'ad_types'       
    ];
}
