<?php
namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UuidModel
 * @package App

 * @method static Builder whereIn($column, $values, $boolean = 'and', $not = false)
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Model|Model[]|null find($id, $columns = ['*'])
 */
class UuidModel extends Model
{
    use UuidTrait;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
}
