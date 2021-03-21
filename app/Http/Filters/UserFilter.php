<?php 

namespace App\Http\Filters;

use App\Http\Filters\QueryFilter;
use Iluminate\Databse\Query\Builder;
use App\Models\User;
use Illuminate\Http\Request;

class UserFilter extends QueryFilter
{   
    public function name($value)
    {
        return $this->builder->where('name', $value);
    }

    public function type($value)
    {
        return $this->builder->where('type', $value);
    }

    public function email($value)
    {
        return $this->builder->where('email', $value);
    }

    public function contract_start_date($value)
    {
        return $this->builder->where('contract_start_date', $value);
    }

    public function contract_end_date($value)
    {
        return $this->builder->where('contract_end_date', $value);
    }

    public function verified($value)
    {
        if($value == 'true') {
            $value = 1;
        } else if ($value = 'false') {
            $value = 0;
        }
        return $this->builder->where('verified', $value);
    }
}
