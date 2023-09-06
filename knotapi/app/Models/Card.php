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
        'card_cvv',
        'user_id'
    ];  
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cardSwitcherTasks()
    {
        return $this->hasMany(CardSwitcherTask::class);
    }
}
