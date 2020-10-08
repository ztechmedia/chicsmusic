<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Search
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function advanceSearch($model, $params)
    {
        $limit = $params['limit'];
        $page = $params['page'];
        $search = $params['search'];
        $max = isset($params['max']) ? $params['max'] : 0;
        $min = isset($params['min']) ? $params['min'] : 0;
        $sort = $params['sort'];

        $totalRecords = $model->getTotal($search, $max, $min, $sort);
        $startIndex = ($page - 1) * $limit;
        $endIndex = $page * $limit;
        $pagination = [];

        if ($totalRecords > 0) {
            
            if($endIndex < $totalRecords) {
                $pagination["next"] = [
                    "page" => $page + 1,
                ];
            }

            if($startIndex > 0) {
                $pagination['prev'] = [
                    "page" => $page-1,
                ];
            }

            $data['products'] = $model->getLimit($limit, $startIndex, $search, $max, $min, $sort);
            $data['total'] = $totalRecords;
            $data['pagination'] = $pagination;
            $data['page'] = $page;
            $data["totalRecords"] = $totalRecords;
            $data["totalPage"] = ceil($totalRecords / $limit);
            $data['start'] = $startIndex + 1;
            $data['end'] = $startIndex + count($data['products']);

            return $data;
        }else{
            return false;
        }
    }
}