<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\EmailInBackground;

use Roave\EmailTemplates\Service\EmailServiceInterface;
use Throwable;
use Zend\Console\ColorInterface;
use Zend\Console\Console;

final class SendEmail
{
    /**
     * @var EmailServiceInterface
     */
    private $emailService;

    /**
     * SendActivationEmail constructor.
     * @param EmailServiceInterface $emailService
     */
    public function __construct(EmailServiceInterface $emailService)
    {
        $this->emailService = $emailService;
    }

    public function __invoke(SendEmailMessage $message)
    {
        $console = Console::getInstance();
        $console->write('Sending email to ', ColorInterface::GREEN);
        $console->write($message->getEmail(), ColorInterface::YELLOW);
        $console->write(' with template ', ColorInterface::GREEN);
        $console->write($message->getTemplate(), ColorInterface::YELLOW);

        try {
            $this->emailService->send($message->getEmail(), $message->getTemplate(), $message->getPayload());

            $console->writeLine(' success', ColorInterface::GREEN);

        } catch (Throwable $e) {

            $console->writeLine(' failed', ColorInterface::RED);
            $console->writeLine($e->getMessage());
            $console->writeLine($e->getTraceAsString());

            // Re-throw it to let bernard handle the exception
            throw $e;
        }
    }
}
