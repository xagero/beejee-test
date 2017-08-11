<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 10.08.2017 14:38
 */

namespace App\Service;

/**
 * Interface UploadInterface
 * @package App\Service
 */
interface UploadInterface
{
    /**
     * Upload data
     *
     * @param array $data
     * @return mixed
     */
    public function process(array $data);
}
