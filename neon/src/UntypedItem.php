<?php
namespace Neon;

use Neon\View\Item;

class UntypedItem implements Item
{
    /** @var callable */
    private $children;

    public function __construct(callable $children)
    {
        $this->children = $children;
    }

    public function html(callable $h): array
    {
        return ($this->children)($h);
    }
}
