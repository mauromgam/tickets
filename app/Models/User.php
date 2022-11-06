<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @package App\Models
 *
 * @method static Builder whereIn($column, $values, $boolean = 'and', $not = false)
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Model|Model[]|null find($id, $columns = ['*'])
 *
 * @property string             id
 * @property string             name
 * @property string             email
 * @property Carbon             created_at
 * @property Carbon             updated_at
 *
 * @property Collection<Ticket> tickets
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UuidTrait;

    const EMAIL_TEST   = 'user@example.com';
    const EMAIL_TEST_2 = 'user2@example.com';

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
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class)
            ->join('users', 'users.id', '=', 'tickets.user_id')
            ->select([
                'tickets.id',
                'tickets.subject',
                'tickets.content',
                'tickets.status',
                'tickets.created_at',
                DB::raw('users.name as user_name'),
                DB::raw('users.email as user_email'),
            ]);
    }
}
