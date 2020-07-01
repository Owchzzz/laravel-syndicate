<?php
namespace Owchzzz\Syndicate\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function members()
    {
        return $this->morphMany()
    }
}
