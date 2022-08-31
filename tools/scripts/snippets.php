<?php

use Viewi\BaseComponent;
use Viewi\Components\Services\DomHelper;
use Viewi\DOM\Events\DOMEvent;

class Resizable extends BaseComponent
{

    function __rendered()
    {
        $this->isMobile = $this->_element->clientWidth <= $this->resizeThreshold;
        $this->emitEvent('mobile-change', $this->isMobile);
        // resize event
        $document = DomHelper::getWindow();
        if ($document !== null) {
            $document->addEventListener('resize', $this->onResize, ['passive' => true]);
        }
    }

    function __destroy()
    {
        // remove resize event
        $document = DomHelper::getWindow();
        if ($document !== null) {
            $document->removeEventListener('resize', $this->onResize, ['passive' => true]);
        }
    }

    // resize event
    function onResize(DOMEvent $event)
    {
        $before = $this->isMobile;
        if ($this->_element->clientWidth > $this->resizeThreshold) {
            // desktop/tablet screen
            $this->isMobile = false;
        } else {
            //mobile screen
            $this->isMobile = true;
        }
        if ($before !== $this->isMobile) {
            $this->emitEvent('mobile-change', $this->isMobile);
        }
    }
}