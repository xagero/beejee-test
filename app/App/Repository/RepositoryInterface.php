<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 19:42
 */

namespace App\Repository;

use App\Storage\AdapterInterface;

/**
 * Interface RepositoryInterface
 * @package App\Repository
 */
interface RepositoryInterface
{
    /**
     * @param AdapterInterface $storage
     * @return mixed
     */
    public function setStorage(AdapterInterface $storage);
}
