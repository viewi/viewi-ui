<?php

namespace ViewiUI\Components\UI\Navigation;

use Viewi\BaseComponent;
use Viewi\Components\Services\DomHelper;
use Viewi\DOM\Events\DOMEvent;

class NavigationDrawer extends BaseComponent
{
    public bool $app = false;
    public bool $absolute = false;
    public bool $fixed = false;
    public bool $bottom = false;
    public bool $clipped = false;
    public bool $floating = false;
    public bool $isMobile = false;
    public bool $isMouseover = false;
    public bool $miniVariant = false;
    public $width = 256;
    public $miniVariantWidth = 56;
    public bool $expandOnHover = false;
    public bool $permanent = false;
    public bool $right = false;
    public bool $temporary = false;
    public bool $dark = false;

    public bool $modelValue = false;

    function __rendered()
    {
        // click outside
        $document = DomHelper::getDocument();
        if ($document !== null) {
            $document->addEventListener('click', $this->onClickOutside, true);
        }
    }

    function __destroy()
    {
        // remove click outside
        $document = DomHelper::getDocument();
        if ($document !== null) {
            $document->removeEventListener('click', $this->onClickOutside, true);
        }
    }

    function getTag()
    {
        return $this->app ? 'nav' : 'aside';
    }

    public function isActive()
    {
        return $this->permanent || $this->modelValue;
    }

    public function isMiniVariant()
    {
        return ($this->expandOnHover && !$this->isMouseover)
            || ($this->miniVariant && !$this->expandOnHover);
    }

    public function onMouseenter()
    {
        $this->isMouseover = true;
    }

    public function onMouseleave()
    {
        $this->isMouseover = false;
    }

    public function onClick()
    {
        if ($this->miniVariant) {
            $this->miniVariant = false;
            $this->emitEvent('mini-update', $this->miniVariant);
        }
    }

    public function getClasses()
    {
        return 'navigation-drawer'
            . ($this->absolute ? ' navigation-drawer-absolute' : '')
            . ($this->bottom ? ' navigation-drawer-bottom' : '') // this.bottom,
            . ($this->clipped ? ' navigation-drawer-clipped' : '') // this.clipped,
            . (!$this->isActive() ? ' navigation-drawer-close' : '') // !this.isActive,
            . (!$this->absolute && ($this->app || $this->fixed) ? ' navigation-drawer-fixed' :  '') // !this.absolute && (this.app || this.fixed),
            . ($this->floating ? ' navigation-drawer-floating' : '') // this.floating,
            . ($this->isMobile ? ' navigation-drawer-is-mobile' : '') // this.isMobile,
            . ($this->isMouseover ? ' navigation-drawer-is-mouseover' : '') // this.isMouseover,
            . ($this->isMiniVariant() ? ' navigation-drawer-mini-variant' : '') // this.isMiniVariant,
            . ($this->miniVariantWidth !== 56 ? ' navigation-drawer-custom-mini-variant' : '') // Number(this.miniVariantWidth) !== 56,
            . ($this->isActive() ? ' navigation-drawer-open' : '') // this.isActive,
            . ($this->expandOnHover ? ' navigation-drawer-open-on-hover' : '') // this.expandOnHover,
            . ($this->right ? ' navigation-drawer-right' : '') // this.right,
            . ($this->temporary ? ' navigation-drawer-temporary' : '') // this.temporary,
            . ($this->dark ? ' theme-dark' : ' theme-light');
    }

    public function getStyles()
    {
        $style = [];
        $style['height'] = '100%';
        $style['width'] = $this->isMiniVariant() ? "{$this->miniVariantWidth}px" : "{$this->width}px";
        $style['top'] = '0px';
        $transform = ($this->isActive() ? 0 : ($this->bottom ? 100 : ($this->right ? 100 : -100)));
        $style['transform'] = "translateX($transform%)";

        $styles = '';
        foreach ($style as $prop => $val) {
            $styles .= "$prop: $val; ";
        }
        return $styles;
    }

    function onOutsideClicked()
    {
        if ($this->modelValue) {
            $this->modelValue = false;
            $this->emitEvent('model', $this->modelValue);
        }
    }

    // click outside
    function onClickOutside(DOMEvent $event)
    {
        if ($this->_element !== $event->target && !$this->_element->contains($event->target)) {
            $this->onOutsideClicked();
        }
    }
}
