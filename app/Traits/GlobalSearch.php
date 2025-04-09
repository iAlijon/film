<?php


namespace App\Traits;


trait GlobalSearch
{
    public static function search($term, $columns = ['name_oz'],$select = ['*'])
    {
        $term = is_array($term) ? implode(' ', $term) : $term;
        return static::select($select)->where(function ($query) use ($term, $columns){
           foreach ($columns as $column) {
               $query->orWhere($column, 'ILIKE', '%'.$term.'%');
           }
        })->get();
    }
}
