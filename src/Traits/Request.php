<?php
/**
 * Request Trait
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
trait Request
{
    /**
     * Request instance variable.
     *
     * @var MvcLite\Request
     */
    protected $request;

    /**
     * Getter for the Request instance.
     *
     * @return MvcLite\Request The Request instance.
     */
    public function getRequest()
    {
        if (!$this->request) {
            $this->request = \MvcLite\Request::getInstance();
        }
        return $this->request;
    }
}
