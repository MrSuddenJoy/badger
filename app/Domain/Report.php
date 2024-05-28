<?php
namespace Coyote\Domain;

use Carbon\Carbon;
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
}
