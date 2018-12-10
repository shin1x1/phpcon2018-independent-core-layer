<?php
declare(strict_types=1);

namespace Acme\Point\Application\AddPoint\Adapters;

use Acme\Point\Application\Eloquents\EloquentCustomer;
use Acme\Point\Application\Eloquents\EloquentCustomerPoint;
use Acme\Point\Core\UseCases\AddPoint\AddPointUseCaseCommand;
use Acme\Point\Core\UseCases\AddPoint\AddPointUseCaseQuery;

final class AppAddPointAdapter implements AddPointUseCaseQuery, AddPointUseCaseCommand
{
    /** @var EloquentCustomer */
    private $customer;

    /** @var EloquentCustomerPoint */
    private $customerPoint;

    /**
     * @param EloquentCustomer $customer
     * @param EloquentCustomerPoint $customerPoint
     */
    public function __construct(EloquentCustomer $customer, EloquentCustomerPoint $customerPoint)
    {
        $this->customer = $customer;
        $this->customerPoint = $customerPoint;
    }

    /**
     * @param int $customerId
     * @return bool
     */
    public function existsCustomerId(int $customerId): bool
    {
        return $this->customer->existsId($customerId);
    }

    /**
     * @param int $customerId
     * @return int
     */
    public function findPoint(int $customerId): int
    {
        return $this->customerPoint->findPoint($customerId);
    }

    /**
     * @param int $customerId
     * @param int $addPoint
     */
    public function addCustomerPoint(int $customerId, int $addPoint): void
    {
        $this->customerPoint->addPoint($customerId, $addPoint);
    }
}
