<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class QueryService
{

    public function GetWhereOrWhere(Model $model, array $names, array $params): Builder
    {

      $where = [];
      foreach ($names as $name) {
        if (array_key_exists($name, $params)) {
          $where[] = [$name,'like','%'.$params[$name].'%'];
        }
      }

      $orWhere = [];
      if (array_key_exists('q', $params)) {
        foreach ($names as $name) {
          $orWhere[] = [$name,'like','%'.$params['q'].'%'];
        }
      }

      return $model->where($where)
        ->where(function ($query) use ($orWhere) {
          if(count($orWhere) > 0) {
            $query->where(...$orWhere[0]);
            for ($i=1; $i < count($orWhere); ++$i) {
              $query->orWhere(...$orWhere[$i]);
            }
          }
        });

    }

}
