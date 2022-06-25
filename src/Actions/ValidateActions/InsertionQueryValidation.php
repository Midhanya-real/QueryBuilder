<?php

namespace Core\Actions\ValidateActions;

class InsertionQueryValidation
{
    public static function isValidBody(array $body): bool
    {
        foreach ($body as $row => $value) {
            if (is_int($row)) {
                return false;
            }
        }

        return true;
    }
}