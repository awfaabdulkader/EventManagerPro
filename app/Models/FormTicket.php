<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormTicket extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable =
    [
        'civility',
        'firstName',
        'lastName',
        'organization',
        'email',
        'phone',
        'phoneCode',
        'job'
    ];


}
