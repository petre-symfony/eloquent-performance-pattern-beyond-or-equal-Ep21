<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Customer;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
        'email_verified_at' => 'datetime',
    ];

    /** Ep21
     * public function scopeOrderByBirthday($query){
     * if (config('database.default') === 'mysql') {
     * $query->orderByRaw('date_format(birth_date, "%m-%d")');
     * }
     *
     * if (config('database.default') === 'sqlite') {
     * $query->orderByRaw('strftime("%m-%d", birth_date)');
     * }
     *
     * if (config('database.default') === 'pgsql') {
     * $query->orderByRaw('to_birthday(birth_date)');
     * }
     * }
     *
     * public function scopeWhereBirtdayThisWeek($query){
     * Carbon::setTestNow(Carbon::parse('January 1, 2023'));
     *
     * $dates = Carbon::now()
     * ->startOfWeek()
     * ->dayUntil(Carbon::now()->endOfWeek())
     * ->map(fn ($date) => $date->format('m-d'));
     *
     * if (config('database.default') === 'mysql') {
     * $query->whereRaw(
     * 'date_format(birth_date, "%m-%d") in (?,?,?,?,?,?,?)',
     * iterator_to_array($dates)
     * );
     * }
     *
     * if (config('database.default') === 'sqlite') {
     * $query->whereRaw(
     * 'strftime("%m-%d", birth_date) in (?,?,?,?,?,?,?)',
     * iterator_to_array($dates)
     * );
     * }
     *
     * if (config('database.default') === 'pgsql') {
     * $query->whereRaw(
     * 'to_birthday(birth_date) in (?,?,?,?,?,?,?)',
     * iterator_to_array($dates)
     * );
     * }
     * }
     *
     * public function scopeOrderByUpcomingBirthdays($query) {
     * if (config('database.default') === 'mysql') {
     * $query->orderByRaw('
     * case
     * when (birth_date + interval (year(?) - year(birth_date)) year) >= ?
     * then (birth_date + interval (year(?) - year(birth_date)) year)
     * else (birth_date + interval (year(?) - year(birth_date)) + 1 year)
     * end
     * ', [
     * array_fill(0, 4, Carbon::now()->startOfWeek()->toDateString()),
     * ]);
     * }
     *
     * if (config('database.default') === 'sqlite') {
     * throw new \Exception('This scope does not support SQLite.');
     * }
     *
     * if (config('database.default') === 'pgsql') {
     * throw new \Exception('This scope does not support Postgres.');
     * }
     * }
     */

    public function posts() {
        return $this->hasMany(Post::class, 'author_id');
    }
}
