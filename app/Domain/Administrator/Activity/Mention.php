<?php
namespace Coyote\Domain\Administrator\Activity;

use Coyote\User;
use Coyote\View\Twig\TwigLiteral;

class Mention
{
    public static function of(User $user): Mention
    {
        return new Mention($user->id, $user->name);
    }

    public function __construct(private int $userId, private string $userName)
    {
    }

    public function mention(): TwigLiteral
    {
        $url = route('profile', [$this->userId]);
        return new TwigLiteral('<a class="mention" href="' . \htmlSpecialChars($url) . '">' . '@' . $this->userName . '</a>');
    }

    public function mentionString(): string
    {
        if ($this->containsAnyOf($this->userName, '. ()')) {
            return "@{{$this->userName}}";
        }
        return '@' . $this->userName;
    }

    private function containsAnyOf(string $string, string $characters): bool
    {
        return \strpbrk($string, $characters) !== false;
    }
}
