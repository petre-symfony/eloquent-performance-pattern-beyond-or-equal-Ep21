<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model {
    use HasFactory;

    public function scopeSelectDistanceTo($query, array $coordinates){
        if (is_null($query->getQuery()->columns)) {
            $query->select('*');
        }

        if (config('database.default') === 'mysql') {
            $query->selectRaw('ST_Distance(
                location,
                ST_SRID(Point(?, ?), 4326)
            ) as distance', $coordinates);
        }

        if (config('database.default') === 'sqlite') {
            throw new \Exception('This lesson does not support SQLite.');
        }

        if (config('database.default') === 'pgsql') {
            $query->selectRaw('ST_Distance(
                location,
                ST_MakePoint(?, ?)::geography
            ) as distance', $coordinates);
        }
    }
}
