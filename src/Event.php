<?php
/**
 * Event class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Event
 * @since       File available since release 3.4.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */

namespace MvcLite;

/**
 * Event class
 *
 * @category    PHP
 * @package     MvcLite
 * @subpackage  Event
 * @since       File available since release 3.4.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
class Event extends \SplSubject
{
    protected $name;
    protected $details;
    protected $observers;

    /**
     * Constructor.
     *
     * @param string $name The name of the event.
     * @param array $details An array of details describing the event.
     */
    public function __construct($name, $details = [])
    {
        $this->observers = new \SplObjectStorage;
        $this->name      = $name;
        $this->details   = $details;
    }

    /**
     * Attaches an observer to the observer storage property.
     *
     * @param \SplObserver $observer The observer to attach.
     *
     * @return MvcLite\Event Returns $this, for object-chaining.
     */
    public function attach(\SplObserver $observer)
    {
        $this->observers->attach($observer);
        return $this;
    }

    /**
     * Detaches an observer to the observer storage property.
     *
     * @param \SplObserver $observer The observer to dettach.
     *
     * @return MvcLite\Event Returns $this, for object-chaining.
     */
    public function detach(\SplObserver $observer)
    {
        $this->observers->detach($observer);
        return $this;
    }

    /**
     * Method to notify observers.
     *
     * @return MvcLite\Event Returns $this, for object-chaining.
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
        return $this;
    }
}
