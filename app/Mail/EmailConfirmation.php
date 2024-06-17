<?php

namespace Coyote\Mail;

class EmailConfirmation extends \Tests\Legacy\Services\Model
{
    /**
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->viewData['url'] = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Prosimy o potwierdzenie nowego adresu e-mail')->view('emails.user.change_email');
    }
}
