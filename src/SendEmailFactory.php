<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\EmailInBackground;

use InteractiveSolutions\Bernard\Router\ConsumerTaskManager;
use Roave\EmailTemplates\Service\EmailService;

class SendEmailFactory
{
    public function __invoke(ConsumerTaskManager $manager): SendEmail
    {
        $container = $manager->getServiceLocator();

        return new SendEmail($container->get(EmailService::class));
    }
}
