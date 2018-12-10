<?php
declare(strict_types=1);

namespace Acme\Point\Core\Domain\Models;

final class CustomerId implements \JsonSerializable
{
    use NumberTrait;
}
