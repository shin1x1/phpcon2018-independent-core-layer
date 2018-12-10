<?php
declare(strict_types=1);

namespace Acme\Point\Core\UseCases\AddPoint;

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
     * @param int $customerId
     * @param int $addPoint
     * @return int
     * @throws DomainRuleException
     */
    public function run(int $customerId, int $addPoint): int
    {
        if ($addPoint <= 0) {
            throw new DomainRuleException('add_point should be equals or greater than 1');
        }

        if (!$this->query->existsCustomerId($customerId)) {
            $message = sprintf('customer_id:%d does not exists', $customerId);
            throw new DomainRuleException($message);
        }

        $this->command->addCustomerPoint($customerId, $addPoint);

        return $this->query->findPoint($customerId);
    }
}
