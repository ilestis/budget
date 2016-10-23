<?php

namespace App;

use App\Traits\FilterableModel;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use FilterableModel;

    protected $fillable = [
        'day',
        'amount',
        'details',
        'budget_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
}