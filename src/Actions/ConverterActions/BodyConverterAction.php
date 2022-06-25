<?php

namespace Core\Actions\ConverterActions;

class BodyConverterAction
{
    public static function getSelectBody(array $body): array
    {
        $select = [];

        foreach ($body as $row => $value) {
            if (!is_int($row)) {
                $select['body'][] = "{$row} AS {$value}";

            } else {
                $select['body'][] = $value;
            }
        }

        return $select;
    }

    public static function getInsertBody(array $body): array
    {
        $insert = [];
        foreach ($body as $row => $value) {
            $insert['body'][$row] = '?';
            $insert['params'][] = $value;
        }

        return $insert;
    }

    public static function getSetBody(array $body, bool $placeHolder = true): array
    {
        $set = [];
        foreach ($body as $row => $value) {
            if (!$placeHolder) {
                $set['body'][] = "{$row} = {$value}";
            } else {
                $set['body'][] = "{$row} = ?";
                $set['params'][] = $value;
            }
        }

        return $set;
    }

    public static function getOrderBody(array $body): array
    {
        $order = [];
        foreach ($body as $row => $mode) {
            if (!is_int($row)) {
                $order['body'][] = "{$row} {$mode}";
            } else {
                $order['body'][] = "{$mode}";
            }
        }

        return $order;
    }
}