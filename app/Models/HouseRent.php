<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HouseRent extends Model
{
    use SoftDeletes;

    const PAID = 'Paid';
    const DUE = 'Due';

    protected $fillable = [
        'from_date', 'to_date', 'amount', 'status', 'remarks',
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
