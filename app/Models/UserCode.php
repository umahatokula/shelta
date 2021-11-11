<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserCode extends Model
{
    use HasFactory;

    public $table = "user_codes";

    protected $fillable = [
        'user_id',
        'code',
    ];

    public function user() {
      return $this->belongsTo(User::class);
    }
}
