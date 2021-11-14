<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    // 配列で設定できるプロパティを記述
    public $fillable = ['title', 'log'];
}
