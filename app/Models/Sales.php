<?php

namespace App\Models;

//3/25
// use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    //3/25
    //use HasFactory;

    //テーブル名
    protected $table = 'sales';

    // 可変項目
    protected $fillable =
    [
        'product_id'
    ];
}