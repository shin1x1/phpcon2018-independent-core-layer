<?php

namespace Acme\Test\Core\UseCasses\AddPointDomain;

use Acme\Point\Core\Domain\Models\AddPoint;
use Acme\Point\Core\Domain\Models\CustomerId;
use Acme\Point\Core\Domain\Models\Point;
use Acme\Point\Core\UseCases\AddPointDomain\AddPointUseCase;
use Acme\Point\Core\UseCases\AddPointDomain\AddPointUseCaseCommand;
use Acme\Point\Core\UseCases\AddPointDomain\AddPointUseCaseQuery;
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
            public function existsCustomerId(CustomerId $customerId): bool
            {
                return true;
            }

            public function findPoint(CustomerId $customerId): Point
            {
                return Point::of(200);
            }
        };


        $this->mockCommand = new class implements AddPointUseCaseCommand
        {
            public function addCustomerPoint(CustomerId $customerId, AddPoint $addPoint): void
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

        $actual = $useCase->run(CustomerId::of(1), AddPoint::of(100));

        $this->assertSame(200, $actual->asInt());
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

        $useCase->run(CustomerId::of(1), AddPoint::of(-1));
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
                public function existsCustomerId(CustomerId $customerId): bool
                {
                    return false;
                }

                public function findPoint(CustomerId $customerId): Point
                {
                    return Point::of(0);
                }
            },
            $this->mockCommand
        );

        $useCase->run(CustomerId::of(1), AddPoint::of(10));
    }
}
