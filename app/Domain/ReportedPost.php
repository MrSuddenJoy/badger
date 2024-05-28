<?php
namespace Coyote\Domain;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Coyote\Domain\Administrator\Activity\Mention;
use Coyote\Domain\Administrator\Activity\PostPreview;
use Coyote\View\Twig\TwigLiteral;

class ReportedPost
{
    private PostPreview $preview;

    public function __construct(
        public int    $id,
        public string $contentMarkdown,
        public int    $authorId,
        public string $authorName,
        public array  $reporterIds,
        public array  $reporterNames,
        public array  $reportTypes,
        public Carbon $createdAt,
        public Carbon $updatedAt,
        public int    $forumId,
        public string $forumSlug,
    )
    {
        $this->preview = new PostPreview($this->contentMarkdown);
    }

    public function url(): string
    {
        return \route('adm.flag.show', [$this->id]);
    }

    public function updatedAgo(): string
    {
        return $this->ago($this->updatedAt);
    }

    public function createdAgo(): string
    {
        return $this->ago($this->createdAt);
    }

    private function ago(Carbon $dateTime): string
    {
        return $this->firstWords($dateTime->diff(Carbon::now()), 4) . ' temu';
    }

    public function reporterMentions(): array
    {
        return \array_map(
            function (int $id, string $name) {
                $mention = new Mention($id, $name);
                return $mention->mention();
            },
            $this->reporterIds, $this->reporterNames,
        );
    }

    private function firstWords(CarbonInterval $interval, int $words): string
    {
        return \implode(' ',
            \array_slice(
                \explode(' ', $interval),
                0, $words));
    }

    public function html(): TwigLiteral
    {
        return $this->preview->html();
    }

    public function preview(): TwigLiteral
    {
        return $this->preview->previewHtml();
    }

    public function authorMention(): TwigLiteral
    {
        $mention = new Mention($this->authorId, $this->authorName);
        return $mention->mention();
    }

    public function forumUrl(): string
    {
        return route('forum.category', [$this->forumSlug]);
    }
}
