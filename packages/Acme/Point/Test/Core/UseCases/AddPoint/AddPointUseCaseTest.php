<?php

namespace Acme\Test\Core\UseCasses\AddPoint;

use Acme\Point\Core\UseCases\AddPoint\AddPointUseCase;
use Acme\Point\Core\UseCases\AddPoint\AddPointUseCaseCommand;
use Acme\Point\Core\UseCases\AddPoint\AddPointUseCaseQuery;
use PHPUnit\Framework\TestCase;

class AddPointUseCaseTest extends TestCase
{
    /** @var AddPointUseCaseQuery */
    private $mockQuery;
    /** @var AddPointUseCaseCommand */
    private $mockCommand;

    protected function setUp()
    {
        parent::setUp();

        $this->mockQuery = new class implements AddPointUseCaseQuery
        {
            public function existsCustomerId(int $customerId): bool
            {
                return true;
            }

            public function findPoint(int $customerId): int
            {
                return 200;
            }
        };


        $this->mockCommand = new class implements AddPointUseCaseCommand
        {
            public function addCustomerPoint(int $customerId, int $addPoint): void
            {
            }
        };
    }


    /**
     * @test
     * @throws \Acme\Point\Domain\Exception\DomainRuleException
     */
    public function run_()
    {
        $useCase = new AddPointUseCase(
            $this->mockQuery,
            $this->mockCommand
        );

        $actual = $useCase->run(1, 100);

        $this->assertSame(200, $actual);
    }

    /**
     * @test
     * @throws \Acme\Point\Domain\Exception\DomainRuleException
     * @expectedException \Acme\Point\Domain\Exception\DomainRuleException
     */
    public function run_with_negative_point()
    {
        $useCase = new AddPointUseCase(
            $this->mockQuery,
            $this->mockCommand
        );

        $useCase->run(1, -1);
    }

    /**
     * @test
     * @throws \Acme\Point\Domain\Exception\DomainRuleException
     * @expectedException \Acme\Point\Domain\Exception\DomainRuleException
     */
    public function run_with_no_exists_customer_id()
    {
        $useCase = new AddPointUseCase(
            new class implements AddPointUseCaseQuery
            {
                public function existsCustomerId(int $customerId): bool
                {
                    return false;
                }

                public function findPoint(int $customerId): int
                {
                    return 0;
                }
            },
            $this->mockCommand
        );

        $useCase->run(1, 10);
    }
}
