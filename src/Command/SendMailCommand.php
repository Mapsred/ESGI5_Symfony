<?php

namespace App\Command;

use App\Utils\MailManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SendMailCommand extends Command
{
    protected static $defaultName = 'app:send-mail';

    /**
     * @var MailManager
     */
    private $mailManager;

    /**
     * SendMailCommand constructor.
     * @param MailManager $mailManager
     * @param string|null $name
     */
    public function __construct(MailManager $mailManager, string $name = null)
    {
        parent::__construct($name);
        $this->mailManager = $mailManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Sending mail')
            ->addOption('end', null, InputOption::VALUE_NONE, 'Send emails for ended objectives.')
            ->addOption('reminder', 'r', InputOption::VALUE_REQUIRED, 'Send emails for objectives with X days remaining.')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('end')) {
            $this->mailManager->sendObjective();
        }elseif(null !== $reminder = $input->getOption('reminder')) {
            $this->mailManager->sendObjective($reminder);
        }
    }
}
