<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 10.08.2017 11:09
 */

namespace App\Service;

/**
 * Class AuthService
 * @package App\Service
 */
class AuthService
{
    /**
     * @var array
     */
    protected $admin;

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    /**
     * @param $identity
     * @param $credential
     * @return bool
     */
    public function isValid($identity, $credential)
    {
        if ($identity != $this->admin['identity']) {
            return false;
        }

        return password_verify($credential, $this->admin['credential']);
    }

    /**
     * Save identity in session
     *
     * @param $identity
     * @return bool
     */
    public function save($identity)
    {
        $_SESSION['identity'] = $identity;
        return true;
    }

    /**
     * Get identity from session if exists
     *
     * @return bool
     */
    public function get()
    {
        if (array_key_exists('identity', $_SESSION)) {
            return $_SESSION['identity'];
        }

        return false;
    }

    /**
     * Clear session identity
     */
    public function clear()
    {
        unset($_SESSION['identity']);
        return true;
    }


}
