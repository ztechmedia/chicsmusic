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
        $this->ci->load->model("BaseModel", "BM");
    }

    public function advanceSearch($model, $params)
    {
        $limit = isset($params['limit']) ? htmlspecialchars($params['limit'], ENT_QUOTES, 'UTF-8') : 12;
        $page = isset($params['page']) ? htmlspecialchars($params['page'], ENT_QUOTES, 'UTF-8') : 1;
        $max = isset($params['max']) ? htmlspecialchars($params['max'], ENT_QUOTES, 'UTF-8') : 0;
        $min = isset($params['min']) ? htmlspecialchars($params['min'], ENT_QUOTES, 'UTF-8') : 0;
        $search = isset($params['search']) ? htmlspecialchars($params['search'], ENT_QUOTES, 'UTF-8') : NULL;
        $sort = isset($params['sort']) ? htmlspecialchars($params['sort'], ENT_QUOTES, 'UTF-8') : 'latest';
        $brand = isset($params['brand']) ? htmlspecialchars($params['brand'], ENT_QUOTES, 'UTF-8') : NULL;
        $subcategories = isset($params['subcategories']) ? htmlspecialchars($params['subcategories'], ENT_QUOTES, 'UTF-8') : "all";

        $totalRecords = $model->getTotal($search, $max, $min, $sort, $brand, $subcategories);
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
            $data['products'] = $model->getLimit($limit, $startIndex, $search, $max, $min, $sort, $brand, $subcategories);
        }else{
            $data['products'] = [];
        }

        
        $data['total'] = $totalRecords;
        $data['pagination'] = $pagination;
        $data['page'] = $page;
        $data["totalRecords"] = $totalRecords;
        $data["totalPage"] = ceil($totalRecords / $limit);
        $data['start'] = $startIndex + 1;
        $data['end'] = $startIndex + count($data['products']);
        //set custom data
        $data["sort"] = $sort;
        $data['limit'] = $limit;
        $data['search'] = $search;
        $data['min'] = $min;
        $data['max'] = $max;
        $data['brand'] = $brand;
        $data['subcategories'] = $subcategories;

        if($subcategories !== "" && $subcategories !== "all") {
            $data['categories'] = $this->ci->BM->getById('subcategories', $subcategories)->category_id;
        }else{
            $data['categories'] = 'all';
        }

        return $data;
    }
}