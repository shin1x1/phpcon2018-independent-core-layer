<?php
declare(strict_types=1);

namespace Acme\Point\Core\Domain\Models;

use Acme\Point\Domain\Exception\DomainRuleException;

final class AddPoint
{
    use NumberTrait;

    /**
     * @param int $value
     * @throws DomainRuleException
     */
    private function __construct(int $value)
    {
        if ($value <= 0) {
            throw new DomainRuleException('add_point should be equals or greater than 1');
        }

        $this->value = $value;
    }
}
