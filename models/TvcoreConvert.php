<?php
/**
 * Cornelius - Core PrestaShop module
 *
 * @author    tivuno.com <hi@tivuno.com>
 * @copyright 2018 - 2024 © tivuno.com
 * @license   https://tivuno.com/blog/bp/business-news/2-basic-license
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

class TvcoreConvert
{
    public static function getMultiplier(mixed $symbol, string $dimension_unit, string $weight_unit)
    {
        if ($symbol == 'mm') {
            if ($dimension_unit == 'mm') {
                return 1;
            } elseif ($dimension_unit == 'cm') {
                return .1;
            } else {
                return .001;
            }
        } elseif ($symbol == 'cm') {
            if ($dimension_unit == 'mm') {
                return 10;
            } elseif ($dimension_unit == 'cm') {
                return 1;
            } else {
                return .01;
            }
        } elseif ($symbol == 'm') {
            if ($dimension_unit == 'mm') {
                return 1000;
            } elseif ($dimension_unit == 'cm') {
                return 100;
            } else {
                return 1;
            }
        } elseif ($symbol == 'g') {
            if ($weight_unit == 'g') {
                return 1;
            } else {
                return .001;
            }
        } elseif ($symbol == 'kg') {
            if ($weight_unit == 'g') {
                return 1000;
            } else {
                return 1;
            }
        }

        return false;
    }
}
