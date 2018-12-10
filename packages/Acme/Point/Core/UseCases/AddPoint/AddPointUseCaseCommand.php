<?php
declare(strict_types=1);

namespace Acme\Point\Core\UseCases\AddPoint;

interface AddPointUseCaseCommand
{
    /**
     * @param int $customerId
     * @param int $addPoint
     */
    public function addCustomerPoint(int $customerId, int $addPoint): void;
}
