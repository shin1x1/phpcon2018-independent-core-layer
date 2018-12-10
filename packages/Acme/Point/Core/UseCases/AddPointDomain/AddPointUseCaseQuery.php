<?php
declare(strict_types=1);

namespace Acme\Point\Core\UseCases\AddPointDomain;

use Acme\Point\Core\Domain\Models\CustomerId;
use Acme\Point\Core\Domain\Models\Point;

interface AddPointUseCaseQuery
{
    /**
     * @param CustomerId $customerId
     * @return bool
     */
    public function existsCustomerId(CustomerId $customerId): bool;

    /**
     * @param CustomerId $customerId
     * @return Point
     */
    public function findPoint(CustomerId $customerId): Point;
}
