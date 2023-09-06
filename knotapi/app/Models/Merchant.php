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
        'website'
    ];  

        public function cardSwitcherTasks()
    {
        return $this->hasMany(CardSwitcherTask::class);
    }
}
