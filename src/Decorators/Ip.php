<?php

namespace Boduch\Grid\Decorators;

use Boduch\Grid\Cell;

class Ip extends Decorator
{
    /**
     * @param Cell $cell
     * @return void
     */
    public function decorate(Cell $cell)
    {
        $cell->setValue($cell->getColumn()->getGrid()->getHtmlBuilder()->tag('abbr', (string) $cell->getValue()));
    }
}
