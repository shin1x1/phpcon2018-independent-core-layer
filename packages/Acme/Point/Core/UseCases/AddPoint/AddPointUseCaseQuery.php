<?php
declare(strict_types=1);

namespace Acme\Point\Core\UseCases\AddPoint;

interface AddPointUseCaseQuery
{
    /**
     * @param int $customerId
     * @return bool
     */
    public function existsCustomerId(int $customerId): bool;

    /**
     * @param int $customerId
     * @return int
     */
    public function findPoint(int $customerId): int;
}
