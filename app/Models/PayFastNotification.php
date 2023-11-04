<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayFastNotification extends Model
{
    protected $table = 'payfast_notifications'; // Specify the table name

    protected $fillable = [
        'm_payment_id',
        'pf_payment_id',
        'payment_status',
        'item_name',
        'amount_gross',
        // Add other fields you want to store
    ];
}
