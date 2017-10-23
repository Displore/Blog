<?php

namespace Displore\Blog\Models;

use App\User as AppUser;
use Illuminate\Database\Eloquent\Model;

class User extends AppUser
{
    public function posts()
    {
        return $this->hasMany('Displore\Blog\Models\Post');
    }
}