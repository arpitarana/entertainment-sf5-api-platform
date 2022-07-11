<?php

namespace App\Manager;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

/**
 * Class MailManager
 * @package App\Manager
 */
class MailManager
{
    const FROM_EMAIL = 'arpita.rana212@gmail.com';

    /** @var MailerInterface */
    private $mailer;

    public function __construct(
        MailerInterface $mailer
    ) {
        $this->mailer = $mailer;
    }


    /**
     * @param $user
     * @param $movie
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function sendEmail($user, $movie)
    {
//        try {
            $message = (new TemplatedEmail())
                ->from(self::FROM_EMAIL)
                ->to(new Address($user->getEmail()))
                ->subject('Movie created')
                ->htmlTemplate('emails/moviecreateEmail.html.twig')

                ->context([
                    'movie' => $movie
                ]);

            $this->mailer->send($message);
//        }
//        catch (\Exception $exception) {
//            $exception->getMessage();
//        }
    }
}