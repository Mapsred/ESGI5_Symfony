<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Twig\Environment;

class SendMailCommand extends Command
{
    protected static $defaultName = 'app:send-mail';

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $environment;

    public function __construct(\Swift_Mailer $mailer, Environment $environment)
    {
        parent::__construct();
        $this->mailer = $mailer;
        $this->environment = $environment;
    }

    protected function configure()
    {
        $this
            ->setDescription('Sending mail')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $message = (new \Swift_Message('Achievement mail'))
            ->setFrom('esgi5@wowesgi.com')
            ->setTo('maxime.marquet1@gmail.com')
            ->setBody(
                $this->environment->render(
                    'emails/achievement.html.twig',
                    array('' => '')
                ),
                'text/html'
            )
        ;

        $this->mailer->send($message);
    }
}
