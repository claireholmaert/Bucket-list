<?php

namespace App\service;



use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Alerte
{

    private $mailer;

    public function __construct(MailerInterface $mailer_interface)
    {
        $this->mailer = $mailer_interface;
    }

    public function envoiMail()
    {
        $mail = (new Email())
            -> from('fifi@afpa.fr')
            -> to('loulou@afpa.fr')
            -> subject('Convocation')
            -> text('Faire un cours avec chatGPT');
        $this->mailer->send($mail);
    }
}