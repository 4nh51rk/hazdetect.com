<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $casts = ['deleted_at' => 'datetime'];
    protected $fillable = [
        'ship_id',
        'container_serial',
        'imei',
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->firstOrFail();
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $like = env('DB_CONNECTION') === 'mysql' ? 'like' : 'ilike';
            $query->where(function ($query) use ($search, $like) {
                $query->where('imei', $like, "%$search%")
                    ->orWhere('container_serial', $like, "%$search%")
                    ->orWhereHas('ship', function ($query) use ($search, $like) {
                        $query->where('name', $like, "%$search%")
                        ->orWhere('ssid', $like, "%$search%")
                        ->orWhere('ssid_password', $like, "%$search%");
                    });
            });
        });
    }

    public function ship() {
        return $this->belongsTo(Ship::class,'ship_id');
    }
}
