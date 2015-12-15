<?php
/**
 * Response Trait
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
trait Response
{
    /**
     * Response instance variable.
     *
     * @var MvcLite\Response
     */
    protected $response;

    /**
     * Getter for the response instance variable.
     *
     * @return MvcLite\Response The response instance.
     */
    public function getResponse()
    {
        if (!$this->response) {
            $this->response = \MvcLite\Response::getInstance();
        }
        return $this->response;
    }
}
