<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
protected $fillable = [
    'animal_id',
    'title',
    'issue_date',
    'file_path',
    'description',
];
protected function casts(): array
{
    return [
        'issue_date' => 'date',
    ];
}
public function animal(): BelongsTo
{
    return $this ->belongsTo(Animal::class);
}
}
