<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Datatables
{
    public function __construct($params = null)
    {
        $this->ci = &get_instance();
    }

    public function setDatatables(
        $table, $tableColumn, $searchAble,
        $actions = null, $options = null, $querySelector = null) {
            
        $ci = $this->ci;
        $ci->load->model('DatatablesModel', "Table");

        $columns = array();
        $index = 0;
        foreach ($tableColumn as $column) {
            $columns[$index] = $column;
            $index++;
        }

        $limit = $ci->input->post('length');
        $start = $ci->input->post('start');
        $order = $columns[$ci->input->post('order')[0]['column']];
        $dir = $ci->input->post('order')[0]['dir'];

        $totalData = $ci->Table->totalDocument($table, $querySelector);
        $totalFiltered = $totalData;

        if (empty($ci->input->post('search')['value'])) {
            $dataTables = $ci->Table->getAll($table, $limit, $start, $order, $dir, $querySelector);
        } else {
            $search = $ci->input->post('search')['value'];
            $dataTables = $ci->Table->dataSearch($table, $limit, $start, $search, $order, $dir, $searchAble, $querySelector);
            $totalFiltered = $ci->Table->dataSearchCount($table, $search, $searchAble, $querySelector);
        }

        $data = array();
        if (!empty($dataTables)) {
            $no = $start + 1;
            foreach ($dataTables as $dt) {
                $deleteMessage = "Apakah anda yakin ingin melakukan tindakan ini?";

                $nestedData['no'] = $no++;
                foreach ($columns as $column) {

                    if ($options && array_key_exists("delete_message", $options)) {
                        if (array_key_exists($column, $options['delete_message'])) {
                            $deleteMessage = str_replace(
                                "[" . $column . "]",
                                $dt->$column,
                                $options['delete_message'][$column]);
                        }
                    }

                    if ($options && array_key_exists("middleware", $options)) {
                        if (array_key_exists($column, $options['middleware'])) {
                            $type = $options['middleware'][$column];
                            $nestedData[$column] = $this->middleware($type, $dt->$column);
                        } else {
                            $nestedData[$column] = $dt->$column;
                        }
                    } else {
                        $nestedData[$column] = $dt->$column;
                    }
                }

                if ($actions) {
                    $actionData['table'] = $table;
                    $actionData['data'] = $dt;
                    $actionData['delete_message'] = $deleteMessage;
                    $nestedData['actions'] = $ci->load->view($actions, $actionData, true);
                }

                $data[] = $nestedData;
            }
        }

        $dataArray = array(
            "draw" => intval($ci->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        return $dataArray;
    }

    public function middleware($type, $value)
    {
        switch ($type) {
            case "toRp":
                return toRp($value);
            case "toDateTime":
                return toDateTime(date_create($value));
            default:
                return null;
        }
    }
}
