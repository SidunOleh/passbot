<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'credentials',
    ];

    protected function getCredentialsAttribute($value)
    {
        return json_decode($value, true);
    }

    protected function setCredentialsAttribute($value)
    {
        $this->attributes['credentials'] = json_encode($value);
    }
}
