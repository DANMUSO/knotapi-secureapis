<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;
    protected $table = 'merchants';
    protected $fillable = [
        'name', 
        'website_url'
    ];  

    public function cardswitcher()
    {
        return $this->hasMany(CardSwitcher::class, 'merchant_id');
    }
}
