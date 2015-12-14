<?php
/**
 * Session Trait
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\Traits;

/**
 * Request Trait.
 *
 * Allows a getter for the requests instance.
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */
trait Session
{
    /**
     * Session instance variable.
     * @var MvcLite\Session
     */
    protected $session;

    /**
     * Getter for the session instance variable.
     *
     * @return MvcLite\Session The session instance.
     */
    public function getSession()
    {
        if (!$this->session) {
            $this->session = \MvcLite\Session::getInstance();
        }
        return $this->session;
    }
}
