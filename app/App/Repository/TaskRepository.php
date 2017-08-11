<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 19:31
 */

namespace App\Repository;

use InvalidArgumentException;

/**
 * Class TaskRepository
 * @package App\Repository
 */
class TaskRepository implements TaskRepositoryInterface
{
    use RepositoryTrait;

    protected $table = 'dbtask';

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
    public function create($username, $email, $text, $image = null, $status = 0)
    {
        $keys = 'username, email, text, image, status';
        $values = ':username, :email, :text, :image, :status';
        $sql = "INSERT INTO {$this->table} ($keys) VALUES ($values)";

        $result = $this->storage->queryResult($sql, [
            'username' => $username,
            'email' => $email,
            'text' => $text,
            'image' => $image,
            'status' => $status
        ]);

        return $result;
    }

    /**
     * Get task by ID
     *
     * @param $id
     * @return mixed
     */
    public function read($id)
    {
        // TODO: Implement read() method.
    }

    /**
     * @param $id
     * @param null $username
     * @param null $email
     * @param null $text
     * @param null $image
     * @return mixed
     */
    public function update($id, $username = null, $email = null, $text = null, $image = null)
    {
        // TODO: Implement update() method.
    }

    /**
     * Update task status
     *
     * @param $id
     * @param $status
     * @return mixed
     */
    public function updateStatus($id, $status = null)
    {
        if (null === $status) {
            $sql = "UPDATE {$this->table} SET status = !status WHERE id = :id";
        } else {

            $status = intval($status);
            $sql = "UPDATE {$this->table} SET status = {$status} WHERE id = :id";
        }

        $result = $this->storage->queryResult($sql, [
            'id' => $id
        ]);

        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id=:id";
        $result = $this->storage->queryResult($sql, [
            'id' => $id
        ]);

        return $result;
    }

    /**
     * @return int
     */
    public function countAll()
    {
        $sql = "SELECT count(*) as total FROM {$this->table}";
        $result = $this->storage->query($sql);
        $count = 0;

        if (isset($result[0]['total'])) {
            $count = (int) $result[0]['total'];
        }

        return $count;
    }

    /**
     * Fetch all data
     *
     * @param string $orderby
     * @param string $orderdir
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function fetchAll($orderby = 'username', $orderdir = 'ASC', $limit = 3, $offset = 0)
    {
        $orderdir = mb_strtoupper($orderdir);
        if (!in_array($orderdir, ['ASC', 'DESC'])) {
            throw new InvalidArgumentException(sprintf('Invalid argument provided: %1$s', $orderdir));
        }

        $sql = "SELECT * FROM {$this->table}";
        $sql.= " ORDER BY {$orderby} {$orderdir}";
        $sql.= " LIMIT {$limit} OFFSET {$offset}";

        return $this->storage->query($sql);
    }
}
