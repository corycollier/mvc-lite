<?php
/**
 * View Trait
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite\Traits;

/**
 * View Trait.
 *
 * Allows a getter for the view instance.
 *
 * @category   PHP
 * @package    MvcLite
 * @subpackage Traits
 * @since      File available since release 3.0.x
 * @author     Cory Collier <corycollier@corycollier.com>
 */
trait View
{
    /**
     * View instance variable.
     *
     * @var MvcLite\View
     */
    protected $view;

    /**
     * Getter for the View instance variable.
     *
     * @return MvcLite\View
     */
    public function getView()
    {
        if (!$this->view) {
            $this->view = \MvcLite\View::getInstance();
        }
        return $this->view;
    }
}
