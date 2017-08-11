<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 19:32
 */

namespace App\Repository;

/**
 * Advanced CRUD
 *
 * Interface RepositoryInterface
 * @package App\Repository
 */
interface TaskRepositoryInterface extends RepositoryInterface
{
    /**
     * Create task in repository
     *
     * @param $username
     * @param $email
     * @param $text
     * @param null $image
     * @param int $status
     * @return mixed
     */
    public function create($username, $email, $text, $image = null, $status = 0);

    /**
     * Get task by ID
     *
     * @param $id
     * @return mixed
     */
    public function read($id);

    /**
     * @param $id
     * @param null $username
     * @param null $email
     * @param null $text
     * @param null $image
     * @return mixed
     */
    public function update($id, $username = null, $email = null, $text = null, $image = null);

    /**
     * Update task status
     *
     * @param $id
     * @param $status
     * @return mixed
     */
    public function updateStatus($id, $status);

    /**
     * Remove by id
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Count all rows
     *
     * @return mixed
     */
    public function countAll();

    /**
     * Fetch all by params
     *
     * @param string $orderby
     * @param string $orderdir
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function fetchAll($orderby = 'username', $orderdir = 'ASC', $limit = 3, $offset = 0);

}
