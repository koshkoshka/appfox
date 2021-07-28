<?php

namespace App\Models;

use App\Events\NewsCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public function company(){
        return $this->belongsTo(Company::class,'company_id');
    }

    public static function boot() {
        parent::boot();

        static::created(function (News $news) {
            NewsCreated::dispatch($news);
        });
    }
}
