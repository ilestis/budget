<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'target',
        'periodicity'
    ];

    private $_spent = false;
    protected $monthScope;
    protected $yearScope;
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'budget_id');
    }

    public function getProgressAttribute()
    {
        return 100 - round(100 * ($this->spent / $this->target));
    }

    public function getProgressColourAttribute()
    {
        if ($this->progress <= 24) {
            return 'danger';
        } elseif ($this->progress <= 49) {
            return 'warning';
        }
        return 'success';
    }

    public function getSpentAttribute()
    {
        if ($this->_spent === false) {
            if ($this->periodicity == 'weekly') {
                $this->_spent = $this->expenses()->whereRaw("WEEK(day) = '" . date('W') . "' and YEAR(day) = '" . $this->yearScope . "'")->sum('amount');
            }
            elseif ($this->periodicity == 'monthly') {
                $this->_spent = $this->expenses()->whereRaw("MONTH(day) = '" . $this->monthScope . "' and YEAR(day) = '" . $this->yearScope . "'")->sum('amount');
            }
            else {
                $this->_spent = $this->expenses()->whereRaw("YEAR(day) = '" . $this->yearScope . "'")->sum('amount');
            }
        }

        return $this->_spent;
    }

    /**
     * Set scopes for stats
     * @param $month
     * @param $year
     */
    public function setScope($month, $year)
    {
        $this->monthScope = $month;
        $this->yearScope = $year;
    }
}