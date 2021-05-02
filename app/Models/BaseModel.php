<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    /**
     * Base Model Application
     * all base methode and attributes
     * @return mixed
     */
class BaseModel extends Model
{
    use HasFactory;

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->name === config('boilerplate.access.role.admin');
    }
}
