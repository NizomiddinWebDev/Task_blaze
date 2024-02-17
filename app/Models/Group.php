<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Group extends Model
{
    use HasFactory,AsSource;

    protected $fillable = [
        'id',
        'name'
    ];

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
