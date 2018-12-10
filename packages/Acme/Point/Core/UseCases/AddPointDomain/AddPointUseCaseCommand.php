<?php
declare(strict_types=1);

namespace Acme\Point\Core\UseCases\AddPointDomain;

use Acme\Point\Core\Domain\Models\AddPoint;
use Acme\Point\Core\Domain\Models\CustomerId;

interface AddPointUseCaseCommand
{
    /**
     * @param CustomerId $customerId
     * @param AddPoint $addPoint
     */
    public function addCustomerPoint(CustomerId $customerId, AddPoint $addPoint): void;
}
