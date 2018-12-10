<?php
declare(strict_types=1);

namespace Acme\Point\Application\AddPoint\Actions;

use Acme\Point\Core\UseCases\AddPoint\AddPointUseCase;
use Illuminate\Http\JsonResponse;

class PutAddPointAction
{
    /** @var AddPointUseCase */
    private $useCase;

    /**
     * @param AddPointUseCase $useCase
     */
    public function __construct(AddPointUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    /**
     * @param AddPointRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function __invoke(AddPointRequest $request): JsonResponse
    {
        $customerId = filter_var($request->json('customer_id'), FILTER_VALIDATE_INT);
        $addPoint = filter_var($request->json('add_point'), FILTER_VALIDATE_INT);

        $customerPoint = $this->useCase->run(
            $customerId,
            $addPoint
        );

        return response()->json(['customer_point' => $customerPoint]);
    }
}
