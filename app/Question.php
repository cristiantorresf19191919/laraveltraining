<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = ['title','body'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /* Aprendiendo Query Scopes */

    public function scopeActive($modelo){
        return $modelo->where('active',1);  
    }

    public function scopePopular($modelo, $nivel){
        return $modelo->where('views','>',$nivel);
    }

    /* Mutator */

    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
}
