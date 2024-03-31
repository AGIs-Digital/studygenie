<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIResponse extends Model
{
    use HasFactory;
    
    // Festlegen des Tabellennamens
    protected $table = 'ai_responses';
    
    // Massenzuweisbare Attribute
    protected $fillable = ['user_id', 'request', 'response'];
    
    // Optional: Beziehung zum User-Modell
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}