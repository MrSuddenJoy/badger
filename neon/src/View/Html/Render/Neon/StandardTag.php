<?php
namespace Neon\View\Html\Render\Neon;

readonly class StandardTag implements NeonTag
{
    private FragmentTag $children;

    public function __construct(
        private ?string $parentClass,
        private string  $tag,
        private array   $attributes,
        array           $children,
    )
    {
        $this->children = new FragmentTag($children);
    }

    public function html(): string
    {
        return "<$this->tag{$this->htmlAttributes()}>{$this->children->html()}</$this->tag>";
    }

    private function htmlAttributes(): string
    {
        if (empty($this->attributes)) {
            return '';
        }
        return ' ' . \implode(' ',
                \array_map(
                    fn(string $key) => $key . '="' . \htmlSpecialChars($this->attributes[$key]) . '"',
                    \array_keys($this->attributes)));
    }

    public function parentClass(): ?string
    {
        return $this->parentClass;
    }
}
