<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QueryFilter
{
    protected $request;
    protected $builder;
  
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
  
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if ( ! method_exists($this, $name)) {
                continue;
            }
            elseif (strlen($value)) {
                $this->$name($value);
            } else {
                $this->$name(NULL);
            }
        }
        return $this->builder;
    }
  
    public function filters()
    {
        return $this->request->all();
    }
}