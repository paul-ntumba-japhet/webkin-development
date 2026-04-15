<?php

namespace App\Models;

use App\Domain\Platform\Enums\SettingType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'is_public',
    ];

    protected function casts() : array
    {
        return [
            'key' => 'string',
            'value' => 'string',
            'type' => SettingType::class,
            'group' => 'string',
            'is_public' => 'boolean',
        ];
    }

}
