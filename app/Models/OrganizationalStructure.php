<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\LogsActivity;

class OrganizationalStructure extends Model
{
    use LogsActivity;
    // 1. Hapus 'section' dari $fillable
    protected $fillable = [
        'name', 
        'position', 
        'nip', 
        'section',
        'photo', 
        'order', 
        'parent_id'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(OrganizationalStructure::class, 'parent_id');
    }

    public function children(): HasMany
    {
        // 2. Ubah pengurutan untuk hanya menggunakan 'order'
        return $this->hasMany(OrganizationalStructure::class, 'parent_id')->orderBy('order');
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }
}