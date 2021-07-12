<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class modal extends Model
{
    protected $table ='modals';
    protected $fillable = ['bulan','modal'];
    
    public function user()
    {
        return $this->belongsTo('App\user');
    }
}
