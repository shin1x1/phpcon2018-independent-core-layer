<?php
declare(strict_types=1);

namespace Acme\Point\Application\Eloquents;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 */
final class EloquentCustomer extends Model
{
    protected $table = 'customers';

    /**
     * @param int $customerId
     * @return bool
     */
    public function existsId(int $customerId): bool
    {
        return $this->newQuery()->where('id', $customerId)->exists();
    }
}
