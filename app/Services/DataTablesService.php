<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class DataTablesService
{
    public function fetchData(Request $request, Model $model, array $columns, array $relations = [])
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowPerPage = $request->get("length");
        $orderArray = $request->get('order');
        $columnNameArray = $request->get('columns');
        $searchArray = $request->get('search');
        $columnIndex = $orderArray[0]['column'];
        $columnName = $columnNameArray[$columnIndex]['data'];
        $columnSortOrder = $orderArray[0]['dir'];
        $searchValue = $searchArray['value'];

        $query = $model::query();

        foreach ($relations as $relation) {
            $query->with($relation);
        }
        
        $total = $query->count();

        if (!empty($searchValue)) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', '%' . $searchValue . '%');
            }
        }

        $totalFilter = $query->count();

        $data = $query->skip($start)
            ->take($rowPerPage)
            ->orderBy($columnName, $columnSortOrder)
            ->get();

        $response = [
            "draw" => intval($draw),
            "recordsTotal" => $total,
            "recordsFiltered" => $totalFilter,
            "data" => $data,
        ];
        return $response;
    }
}
