<?php
namespace Neon;

use Neon\View\Language\Polish;
use Neon\View\View;

readonly class Application
{
    public function __construct(
        private string                 $applicationName,
        private Persistence\Attendance $attendance,
        private Persistence\JobOffers  $jobOffers,
        private Persistence\Events     $events,
        private Domain\Visitor         $visitor,
        private Persistence\System     $system,
    )
    {
    }

    public function html(string $csrf): string
    {
        $view = new View(
            new Polish(),
            $this->applicationName,
            $this->events->fetchEvents(),
            $this->attendance->fetchAttendance(),
            $this->jobOffers->fetchJobOffers(), // <-- this is untested
            $this->visitor,
            $csrf,
            $this->system->darkTheme());
        return $view->html();
    }

    /**
     * @todo #25 Think of the proper name. Current name is just placeholder
     * @author @MrSuddenJoy
     */
    public function applicationRunner(string $csrf):string {
      $view = new View(
        new Polish(),
        $this->applicationName,
        $this->events->fetchEvents(),
        $this->attendance->fetchAttendance(),
        $this->jobOffers->fetchJobOffers(),
        $this->visitor,
        $csrf,
        $this->system->darkTheme()
      );
      return $view->html();
    }
}
