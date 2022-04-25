<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ship extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $casts = ['deleted_at' => 'datetime'];
    protected $fillable = [
        'name',
        'imo',
        'ssid',
        'ssid_password',
        'ipv4',
        'wifi_ping',
        'gsm_ping',
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
                $query->where('name', $like, "%$search%")
                    ->orWhere('imo', $like, "%$search%")
                    ->orWhere('ssid', $like, "%$search%")
                    ->orWhere('ssid_password', $like, "%$search%")
                    ->orWhere('ipv4', $like, "%$search%")
                    ->orWhere('wifi_ping', $like, "%$search%")
                    ->orWhere('gsm_ping', $like, "%$search%");
            });
        });
    }

    public function devices() {
        return $this->hasMany(Device::class);
    }
}
