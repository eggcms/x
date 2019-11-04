<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
   public function sluggable()
   {
       return [
           'slug' => [
               'source' => 'title'
           ]
       ];
   }
   
   public function getRouteKeyName()
   {
      return 'slug';
   }
}
