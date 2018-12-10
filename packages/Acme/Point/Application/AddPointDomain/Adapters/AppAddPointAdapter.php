<?php
declare(strict_types=1);

namespace Acme\Point\Application\AddPointDomain\Adapters;

use Acme\Point\Application\Eloquents\EloquentCustomer;
use Acme\Point\Application\Eloquents\EloquentCustomerPoint;
use Acme\Point\Core\Domain\Models\AddPoint;
use Acme\Point\Core\Domain\Models\CustomerId;
use Acme\Point\Core\Domain\Models\Point;
use Acme\Point\Core\UseCases\AddPointDomain\AddPointUseCaseCommand;
use Acme\Point\Core\UseCases\AddPointDomain\AddPointUseCaseQuery;

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
     * @param CustomerId $customerId
     * @return bool
     */
    public function existsCustomerId(CustomerId $customerId): bool
    {
        return $this->customer->existsId($customerId->asInt());
    }

    /**
     * @param CustomerId $customerId
     * @return Point
     */
    public function findPoint(CustomerId $customerId): Point
    {
        return Point::of($this->customerPoint->findPoint($customerId->asInt()));
    }

    /**
     * @param CustomerId $customerId
     * @param AddPoint $addPoint
     */
    public function addCustomerPoint(CustomerId $customerId, AddPoint $addPoint): void
    {
        $this->customerPoint->addPoint($customerId->asInt(), $addPoint->asInt());
    }
}
