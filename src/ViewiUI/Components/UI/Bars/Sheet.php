<?php

namespace ViewiUI\Components\UI\Bars;

use Viewi\BaseComponent;

class Sheet extends BaseComponent
{
    public bool $outlined = false;
    public bool $shaped = false;
    /**
     * @options [null, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12,
     *           13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24]
     * @var null|int
     */
    public ?int $elevation = null;
    /**
     * 
     * @var bool|string
     */
    public $rounded = false;
    public bool $tile = false;
    public ?string $class = null;

    private function roundedClasses()
    {
        if ($this->rounded) {
            if ($this->rounded === true) {
                return ' rounded';
            }
            $parts = explode(' ', $this->rounded);
            $classes = '';
            foreach ($parts as $part) {
                $classes .= ' rounded-' . $part;
            }
            return $classes;
        }
        return '';
    }

    public function getClasses()
    {
        return 'viewi-sheet'
            . ($this->outlined ? ' sheet-outlined' : '')
            . ($this->shaped ? ' sheet-shaped' : '')
            . ($this->elevation !== null ? ' sheet-elevated elevation-' . $this->elevation : '')
            . $this->roundedClasses()
            . ' theme-light'
            . ($this->class !== null ? ' ' . $this->class : '');
        // themes
    }
}
