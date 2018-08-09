<?php


namespace core;


class DB
{
    public static function request($table, $arr = null, $f = null, $seperator = 'and', $order = null, $limit = null){
        $table = System::$SETTINGS->db->sol.System::$DB->escape_string($table);
        $where = '';
        $col = 0;
        if(!is_null($arr)) {
            $where .= ' where ';
            foreach ($arr as $key => $value) {
                $where .= System::$DB->escape_string($key) . '=\'' . System::$DB->escape_string($value) . '\' ';
                if ($col != count($arr) - 1) {
                    $where .= $seperator . ' ';
                }
                $col++;
            }
        }
        $sql = "Select * from {$table}";
        if(count($arr) > 0){
            $sql .= $where;
        }
        if(!is_null($order)){
            $sql .= ' ORDER BY'.$order;
        }
        if(!is_null($limit)){
            $sql .= ' LIMIT '.$limit;
        }
        $qwe = System::$DB->query($sql);
        if(!is_null($f)){
            while ($row = $qwe->fetch_array(MYSQLI_ASSOC)){
                call_user_func($f, $row);
            }
        }else{
            $rows = [];
            while ($row = $qwe->fetch_array(MYSQLI_ASSOC)){
                $rows[] = $row;
            }
            return $rows;
        }
        return true;
    }
    public function request_sql($sql, $params){
        foreach ($params as $key => $value){
            $sql = str_replace(':'.$key, $value, $sql);
        }
    }
    public static function get_fields_names($table){
        $qwe = System::$DB->query('DESCRIBE '.System::$SETTINGS->db->sol.System::$DB->escape_string($table));
        $names = [];
        while ($row = $qwe->fetch_array(MYSQLI_ASSOC)){
            $names[] = $row['Field'];
        }
        return $names;
    }
}