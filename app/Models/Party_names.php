<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party_names extends Model
{
    protected $fillable = [
        'party_name',
        'location',
        'billing_name',
        'contact_person',
        'contact_number',
        'email',
        'executive_name',
        'no_of_licenses',
        'amc_start_date',
        'amc_expiry_date',
        'past_amc_charge',
        'new_quoted_amc_charge',
        'amc_status',
        'payment_status',
        'address',
    ];
}
