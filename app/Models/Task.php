<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Task extends Model
{
    use HasFactory,AsSource;

    protected $fillable = [
        'group_id',
        'employee',
        'body'
    ];

    public function group(){
        return $this->belongsTo(Group::class);
    }
}
