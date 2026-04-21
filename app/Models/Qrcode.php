<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{
    protected $fillable = ['content', 'qrcode_path', 'user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
