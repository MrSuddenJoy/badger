<?php
namespace Coyote\Domain;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Coyote\Domain\Administrator\Activity\Mention;
use Coyote\View\Twig\TwigLiteral;

class Report
{
    public function __construct(
        public int     $reportId,
        public int     $reporterId,
        public string  $reporterName,
        public string  $reportType,
        public ?string $reportNote,
        public Carbon  $reportedAt,
    )
    {
    }

    public function reporterMention(): TwigLiteral
    {
        $mention = new Mention($this->reporterId, $this->reporterName);
        return $mention->mention();
    }

    public function reportedAgo(): string
    {
        return $this->ago($this->reportedAt);
    }

    private function ago(Carbon $dateTime): string
    {
        return $this->firstWords($dateTime->diff(Carbon::now()), 4) . ' temu';
    }

    private function firstWords(CarbonInterval $interval, int $words): string
    {
        return \implode(' ',
            \array_slice(
                \explode(' ', $interval),
                0, $words));
    }
}
