<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
   protected $fillable = [
    'name',
    'num_qrcode',
    'price',
    'price_id'
   ];
   public function subscriptions(){
    return $this->hasMany(Subscription::class);
   }
}
