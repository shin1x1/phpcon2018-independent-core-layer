<?php
declare(strict_types=1);

namespace Acme\Point\Core\UseCases\AddPointDomain;

use Acme\Point\Core\Domain\Models\AddPoint;
use Acme\Point\Core\Domain\Models\CustomerId;
use Acme\Point\Core\Domain\Models\Point;
use Acme\Point\Domain\Exception\DomainRuleException;

final class AddPointUseCase
{
    /** @var AddPointUseCaseQuery */
    private $query;

    /** @var AddPointUseCaseCommand */
    private $command;

    /**
     * @param AddPointUseCaseQuery $query
     * @param AddPointUseCaseCommand $command
     */
    public function __construct(AddPointUseCaseQuery $query, AddPointUseCaseCommand $command)
    {
        $this->query = $query;
        $this->command = $command;
    }

    /**
     * @param CustomerId $customerId
     * @param AddPoint $addPoint
     * @return Point
     * @throws DomainRuleException
     */
    public function run(CustomerId $customerId, AddPoint $addPoint): Point
    {
        if (!$this->query->existsCustomerId($customerId)) {
            $message = sprintf('customer_id:%d does not exists', $customerId->asInt());
            throw new DomainRuleException($message);
        }

        $this->command->addCustomerPoint($customerId, $addPoint);

        return $this->query->findPoint($customerId);
    }
}
