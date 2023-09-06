<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardSwitcher extends Model
{
    use HasFactory;
    protected $table = 'card_switchers';
    protected $fillable = [
        'card_id', 'merchant_id', 'status'
    ];  

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
    
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
