<?php

if(!function_exists('UpdateCKFinderUserRole')){
    function UpdateCKFinderUserRole($user){
        if (session_id() == '') {
            @session_start();
        }
        if ($user->can('ckfinder-admin')) {
            $_SESSION['CKFinder_UserRole'] = 'admin';
        }elseif($user->can('ckfinder-user')){
            $_SESSION['CKFinder_UserRole'] = 'user';
        }else{
            $_SESSION['CKFinder_UserRole'] = 'default';
        }
    }
}

if(!function_exists('get_value_system')){
    function get_value_system($system_data, $system_config, $local = 'vi'){
        $temp = null;
        if (!empty($system_config)) {
            foreach ($system_config as $key => $value) {
                if (!empty($value)) {
                    foreach ($value as $k => $val) {
                        $temp[$key][$key.'_'.$k] = $val;
                        if ($val['type'] == 'dropdown' && !isset($val['data']) && isset($val['table'])) {
                            $temp[$key][$key.'_'.$k]['data'] = \DB::table($val['table'])->select('id','title')->whereNull('deleted_at')->where('alanguage', $local)->get();
                            $temp[$key][$key.'_'.$k]['value'] = isset($system_data[$key.'_'.$k]) ? (int)$system_data[$key.'_'.$k] : '';
                        }else{
                            $temp[$key][$key.'_'.$k]['value'] = isset($system_data[$key.'_'.$k]) ? $system_data[$key.'_'.$k] : '';
                        }
                    }
                }
                
            }
        }
        return $temp;
    }
}

if(!function_exists('get_update_and_create')){
    function get_update_and_create($system_data, $system_config, $local = 'vi'){
        $temp = $temp_data = null;
        $data_create_and_update = array(
            'create' => [],
            'update' => []
        );
        foreach ($system_config as $k => $val) {
            // foreach ($value as $k => $val) {
                if (in_array($k, $system_data)) {
                    $data_create_and_update['update'][$k]['keyword'] = $k;
                    $data_create_and_update['update'][$k]['content_'.$local] = $val;
                }else{
                    $data_create_and_update['create'][$k]['keyword'] = $k;
                    $data_create_and_update['create'][$k]['content_'.$local] = $val;
                }
            // }
        }
        return $data_create_and_update;
    }
}

if(!function_exists('updateBatch')){
    function updateBatch($table, $data = array(), $key, $columnUpdate)
    {
        $cases = $ids = $params = [];
        foreach ($data as $task) {
            $keyUniqui = $task[$key];
            $cases[] = "WHEN '{$keyUniqui}' THEN ?";
            $params[] = $task[$columnUpdate];
            $keys[] = "'{$keyUniqui}'";
        }
        $keys = implode(',', $keys);
        $cases = implode(' ', $cases);
        return \DB::update("UPDATE `{$table}` SET `{$columnUpdate}` = CASE `{$key}` {$cases} END WHERE `{$key}` IN({$keys})", $params);
    }
}