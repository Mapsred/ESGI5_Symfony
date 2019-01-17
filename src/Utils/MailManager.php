<?php
/**
 * Created by PhpStorm.
 * User: fma
 * Date: 14/01/19
 * Time: 13:46
 */

namespace App\Utils;


use App\Entity\Objective;
use App\Repository\ObjectiveRepository;
use Twig\Environment;

class MailManager
{
    /** @var \Swift_Mailer $mailer */
    private $mailer;

    /** @var Environment $environment */
    private $environment;

    /** @var ObjectiveRepository */
    private $objectiveRepository;

    /**
     * MailManager constructor.
     * @param \Swift_Mailer $mailer
     * @param Environment $environment
     * @param ObjectiveRepository $objectiveRepository
     */
    public function __construct(\Swift_Mailer $mailer, Environment $environment,
                                ObjectiveRepository $objectiveRepository)
    {
        $this->mailer = $mailer;
        $this->environment = $environment;
        $this->objectiveRepository = $objectiveRepository;
    }

    /**
     * @param string|null $time
     */
    public function sendObjective(string $time = null): void
    {
        $date = null;
        if (null !== $time) {
            $date = new \DateTime();
            $date = $date->sub(new \DateInterval(sprintf("P%sD", $time)));
        }

        $objectives = $this->objectiveRepository->findByMailNotSent($date);
        foreach ($objectives as $objective) {
            $this->sendObjectiveMail($objective, $time);
        }
    }

    /**
     * @param Objective $objective
     * @param string $time
     */
    public function sendObjectiveMail(Objective $objective, string $time = null): void
    {
        $title = '[WowCollection] - Objective %s';
        $title = null === $time ? sprintf($title, 'ended') : sprintf($title, 'reminder');

        $message = new \Swift_Message($title);

        $message
            ->setFrom('esgi5@wowesgi.com')
            ->setTo($objective->getBnetOauthUser()->getEmail())
            ->setBody($this->environment->render('emails/achievement.html.twig', [
                'objective' => $objective,
                'time' => $time
            ]), 'text/html');

        $this->mailer->send($message);
        $objective->setMailSent(true);
        $this->objectiveRepository->save($objective);
    }
}