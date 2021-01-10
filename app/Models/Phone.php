<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'phone'];

    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function getPhoneAttribute($value)
    {
        if(empty($value)) return '';
        $value = preg_replace('/[^0-9]/', '', $value);
        if(strlen($value) < 7) return $value;
        if($value[0] == '1') $value = substr($value, 1);
        return '('.substr($value, 0, 3).') '.substr($value, 3, 3).'-'.substr($value, 6);
    }
}
