<?php
declare(strict_types=1);

namespace Acme\Point\Core\Domain\Models;

trait NumberTrait
{
    /** @var int */
    private $value;

    /**
     * @param int $value
     */
    private function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @param int $value
     * @return self
     */
    public static function of(int $value): self
    {
        return new self($value);
    }

    /**
     * @return int
     */
    public function asInt(): int
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function jsonSerialize()
    {
        return $this->asInt();
    }
}
