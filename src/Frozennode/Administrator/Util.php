<?php

namespace Frozennode\Administrator;


class Util
{
    public static function count($data): int
    {
        if (\is_array($data) || $data instanceof \Countable) {
            return \count($data);
        }
        return 0;
    }
}