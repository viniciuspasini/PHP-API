<?php

namespace Vinip\Api\Utils;

use Exception;

class Validator
{
    /**
     * @throws Exception
     */
    public static function validate(array $fields)
    {
        foreach ($fields as $field => $value) {
            if (empty(trim($value))){
                throw new Exception("the field {$field} is empty}");
            }
        }

        return $fields;
    }
}