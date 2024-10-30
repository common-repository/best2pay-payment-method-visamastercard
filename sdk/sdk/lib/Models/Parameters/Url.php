<?php

namespace B2P\Models\Parameters;

use B2P\Common\Exceptions\NotValidParamException;

/**
 * @todo ПЦ фактически не смотрит на корректность адреса, проверяя его как параметр только по длине.
 *          Следует ли нам жестить?
 */
class Url extends AbstractParameter
{
    protected string $value;

    function __construct(string $value)
    {
        if (strlen($value) <= 500) {
            $this->value = $value;
            return;
        }
        throw new NotValidParamException('Incorrect Url parameter format');
    }
}