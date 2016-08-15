<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\EmailInBackground;

use Exception;
use Roave\EmailTemplates\Service\EmailServiceInterface;
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
        $console->writeLine($message->getTemplate(), ColorInterface::YELLOW);

        try {
            $this->emailService->send($message->getEmail(), $message->getTemplate(), $message->getPayload());

            $console->writeLine('Successfully sent email', ColorInterface::GREEN);

        } catch (Exception $e) {
            $console->writeLine(sprintf('Failed to send email with error %s', $e->getMessage()), ColorInterface::RED);

            // Re-throw it to let bernard handle the exception
            throw $e;
        }
    }
}
