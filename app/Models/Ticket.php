<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Ticket
 *
 * @package App\Models
 *
 * @method static Builder whereIn($column, $values, $boolean = 'and', $not = false)
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder join($table, $first, $operator = null, $second = null, $type = 'inner', $where = false)
 * @method static Model|Model[]|null find($id, $columns = ['*'])
 *
 * @property string  id
 * @property string  user_id
 * @property string  subject
 * @property string  content
 * @property boolean status
 * @property Carbon  created_at
 * @property Carbon  updated_at
 */
class Ticket extends UuidModel
{
    use HasFactory;

    protected $table = 'tickets';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'subject',
        'content',
        'status',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
