<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 10.08.2017 18:49
 */

namespace App\Service;

/**
 * Class PaginatorService
 * @package App\Service
 */
class PaginatorService
{
    /**
     * @var array
     */
    protected $config;

    protected $currentPage = 1;

    protected $firstPage = 1;

    protected $lastPage = 1;

    protected $limit;

    protected $offset = 0;

    /**
     * Total element
     *
     * @var int
     */
    protected $total;

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * Build url
     *
     * @param $data
     * @param array $logic
     * @return string
     */
    public function url($data, $logic = [])
    {
        $sortby = (isset($data['sortby'])) ? $data['sortby'] : $this->config['sortby'];
        $sortdir = (isset($data['sortdir'])) ? $data['sortdir'] : $this->config['sortdir'];

        $link = http_build_query($data + [
            'sortby' => $sortby,
            'sortdir' => $sortdir
        ]);

        return '/index.php?' . $link;

    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @param $page
     */
    public function setCurrentPage($page)
    {
        $this->currentPage = $page;
    }

    /**
     *
     */
    public function getTotalPage()
    {
        if ($this->total) {
            return ceil($this->total / $this->config['perpage']);
        }

        return 1;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->config['perpage'];
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        $this->offset = ($this->currentPage - 1) * $this->config['perpage'];
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;
    }


}
