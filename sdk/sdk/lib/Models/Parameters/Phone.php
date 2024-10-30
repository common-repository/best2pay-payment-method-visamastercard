<?php

namespace B2P\Models\Parameters;

use B2P\Common\Exceptions\NotValidParamException;

/**
 * @todo ПЦ фактически не смотрит на корректность номера, проверяя его как параметр только по длине.
 *          Следует ли нам жестить?
 */
class Phone extends AbstractParameter
{
    protected string $value;

    function __construct(string|int $value)
    {
        $value = (string)$value;
        if (strlen($value) <= 100) {
            $this->value = $value;
            return;
        }
        throw new NotValidParamException('Incorrect Phone parameter format');
    }
}