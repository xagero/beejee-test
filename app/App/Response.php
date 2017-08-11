<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 09.08.2017 16:22
 */

namespace App;

/**
 * Class Response
 * @package App
 */
class Response
{
    /**
     * @var mixed
     */
    protected $content;

    /**
     * @var string
     */
    protected $template = '';

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;
    }


    /**
     * To string
     * @return string
     */
    public function __toString()
    {
        ob_start();

        require $this->template;
        $content = ob_get_clean();

        return $content;
    }

    /**
     * Redirect to location
     *
     * @param $location
     */
    public function redirect($location = '/')
    {
        header("Location: {$location}");
        exit();
    }


}
