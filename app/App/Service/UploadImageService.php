<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 10.08.2017 13:21
 */

namespace App\Service;

use Exception;

/**
 * Class UploadImageService
 * @package App\Service
 */
class UploadImageService implements UploadInterface
{
    /**
     * @var array
     */
    protected $config;

    /**
     * Handle process upload
     *
     * @param array $data
     * @return string
     * @throws Exception
     */
    public function process(array $data)
    {

        if ($data['error'] != UPLOAD_ERR_OK) {
            throw new Exception('Failed upload');
        }

        $destination = 'upload/' . basename($data['name']);
        $destination = preg_replace('/\s+/', '', $destination);

        if (!move_uploaded_file($data['tmp_name'], $destination)) {
            throw new Exception('Cannot move uploaded file');
        }

        return $destination;
    }
}
