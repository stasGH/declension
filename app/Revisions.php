<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revisions extends Model
{
    public $table = 'dict_revisions';

    public static function get_values($str)
    {
        $simple = $str;
        $p = xml_parser_create();
        xml_parse_into_struct($p, $simple, $vals, $index);
        xml_parser_free($p);
        foreach($vals as $val)
            if (isset($val['tag']) && ($val['tag'] == 'F') &&
                isset($val['type']) && ($val['type'] == 'open'))
               $res[] = $val['attributes']['T'];
        return $res;
    }
}