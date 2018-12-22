<?php

/**
 * @author     Konstantinos A. Kogkalidis <konstantinos@tapanda.gr>
 * @copyright  2018 tapanda.gr <https://tapanda.gr/el/>
 * @license    Free for personal use. No warranty. Contact us at info@tapanda.gr for details
 */

require_once _PS_MODULE_DIR_.'tp_framework/tp_framework.php';

class FrameworkArray
{
    /**
    * It isolates a single column (with the respective values) from a given array
    */
    public static function getColumnFromArray($array, $index)
    {
        $result = array();

        for ($x=0; $x < count($array); $x++)
        {
            $result[$x] = $array[$x][$index];
        }

        return $result;
    }

    /**
    *
    */
    public function updatePositions($table, $result)
    {
        $result[0]['absolute_position'] = 0;

        for ($x=1; $x < count($result); $x++)
        {
            $y = $x - 1;

            while ($result[$x]['parent'] != $result[$y]['id_'.$table] and $result[$x]['parent'] != $result[$y]['parent'])
            {
                $y--;
            }

            if ($result[$x]['parent'] == $result[$y]['id_'.$table])
                $result[$x]['absolute_position'] = $result[$y]['absolute_position'] + 1;
            else
                $result[$x]['absolute_position'] = $result[$y]['absolute_position'] + count($result[$y]['descendants']) + 1;
        }

        return $result;
    }

    /**
    *
    */
    public static function bubbleSort($result, $field = 'absolute_position')
    {
        for ($x = 0; $x < count($result) - 1; $x++)
        {
            for ($y = count($result) - 1; $y > $x; $y--)
            {
                if ($result[$x][$field] > $result[$y][$field])
                {
                    $temp = $result[$x];
                    $result[$x] = $result[$y];
                    $result[$y] = $temp;
                }
            }
        }

        return $result;
    }

    /**
    *
    */
    public function getArrayWithExtraLink($controller, $table, $array, $action = null)
    {
        //Put controller url in
        $controller = FrameworkLink::getAdminLink($controller, $action);

        for ($x=0; $x < count($array); $x++)
        {
            $array[$x]['extra_link'] = $controller.'&cid='.$array[$x]['id_'.$table];
        }

        return $array;
    }
}
