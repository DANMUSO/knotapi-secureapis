<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';
    protected $fillable = [
        'card_number', 
        'card_expiry_date', 
        'card_cvv'
    ];  

    public function cardswitcher()
    {
        return $this->hasMany(CardSwitcher::class, 'card_id');
    }
}
