<?php
namespace Coyote\Domain\Administrator\Activity;

<<<<<<< HEAD:app/Domain/Administrator/Activity/PostPreview.php
use Coyote\View\Twig\TwigLiteral;
=======
use Coyote\Domain\Html;
>>>>>>> 6ab42b611 (Extract PostMarkdown from PostPreview):app/Domain/Administrator/View/PostPreview.php
use DOMElement;

class PostPreview extends Html
{
    public function __construct(private string $postHtml)
    {
    }

    protected function toHtml(): string
    {
<<<<<<< HEAD:app/Domain/Administrator/Activity/PostPreview.php
        return \str_contains($this->contentMarkdown, "\n");
    }

    public function previewHtml(): ?TwigLiteral
    {
        $content = $this->previewString($this->htmlString());
        if ($content) {
            return new TwigLiteral($content);
        }
        return null;
    }

    public function html(): TwigLiteral
    {
        return new TwigLiteral($this->htmlString());
    }

    private function htmlString(): string
    {
        return app('parser.post')->parse($this->contentMarkdown);
    }

    private function previewString(string $html): ?string
    {
        if ($html === '') {
            return '';
        }
        $document = new \DOMDocument();
        $document->loadHTML("<html><head><meta charset='utf-8'></head><body>$html</body></html>");
        return $this->htmlWithoutBlockQuotes($document);
    }

    private function htmlWithoutBlockQuotes(\DOMDocument $document): ?string
=======
        if ($this->postHtml === '') {
            return '';
        }
        return $this->firstParagraph($this->document($this->postHtml));
    }

    private function firstParagraph(\DOMDocument $document): string
>>>>>>> 6ab42b611 (Extract PostMarkdown from PostPreview):app/Domain/Administrator/View/PostPreview.php
    {
        $xPath = new \DOMXPath($document);
        /** @var DOMElement $item */
        foreach ($xPath->query('/html/body/*') as $item) {
            if ($item->tagName === 'p') {
                return $this->elementToHtml($item);
            }
        }
        return '';
    }

    private function elementToHtml(DOMElement $element): string
    {
        return $element->ownerDocument->saveHTML($element);
    }

    private function document(string $html): \DOMDocument
    {
        $document = new \DOMDocument();
        $document->loadHTML("<html><head><meta charset='utf-8'></head><body>$html</body></html>");
        return $document;
    }
}
