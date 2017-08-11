<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 19:48
 */

namespace App\Repository;

use App\Storage\AdapterInterface;

/**
 * Trait RepositoryTrait
 * @package App\Repository
 */
trait RepositoryTrait
{
    /**
     * @var AdapterInterface
     */
    protected $storage;

    /**
     * @param AdapterInterface $storage
     */
    public function setStorage(AdapterInterface $storage)
    {
        $this->storage = $storage;
    }
}
