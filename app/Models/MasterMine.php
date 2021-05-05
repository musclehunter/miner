<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MasterMine
 *
 * @property int $id
 * @property string $name
 * @property int $distance
 * @property string $description
 * @package App\Models
 */
class MasterMine extends Model
{
    use HasFactory;
}
