<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'rut'
    ];

    public $timestamps = false;

    public function scopeNameLike($query, $values)
    {
        if (!empty($values))
        {
            $names = explode(" ", $values);

            foreach ($names as $name)
            {
                $query->where("name", 'like', "%$name%");
            }
        }
    }

    public function scopeRutLike($query, $value)
    {
        if (!empty($value))
        {
            $query->where("rut", 'like', "%$value%");
        }
    }
}
