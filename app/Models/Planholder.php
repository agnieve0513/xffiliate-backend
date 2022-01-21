<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planholder extends Model
{
    use HasFactory;

    protected $table = 'planholders';

    protected $fillable = [
        "agent_id",
        "user_id",
        "lastname",
        "firstname",
        "middlename",
        "lot_block",
        "street",
        "barangay",
        "municipality",
        "province",
        "dob",
        "religion",
        "contact",
        "civil_status",
        "gender",
        "region",
    ];

    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }
}
