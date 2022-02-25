<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    //    protected $table='posts';
    //    public $primarykey='id';
    //    public $timesstamps=false;
  public function user(){
            return $this->belongsTo('App\User');
          }
}
