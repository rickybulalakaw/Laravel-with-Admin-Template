<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geography extends Model
{
    use HasFactory;

    public const BARANGAY = 1;
    public const SUBMUNICIPALITY = 2;
    public const MUNICIPALITY = 3;
    public const CITY = 4;
    public const PROVINCE = 5;
    public const DISTRICT = 6;
    public const REGION = 7;

    public const LUZON = 1;
    public const VISAYAS = 2;
    public const MINDANAO = 3;
}
