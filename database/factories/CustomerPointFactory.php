<?php
declare(strict_types=1);

use Acme\Point\Application\Eloquents\EloquentCustomerPoint;

$factory->define(EloquentCustomerPoint::class, function () {
    return [
        'point' => 0,
    ];
});
