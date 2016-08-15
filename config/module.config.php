<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

use InteractiveSolutions\EmailInBackground\SendEmail;
use InteractiveSolutions\EmailInBackground\SendEmailFactory;

return [
    'interactive_solutions' => [

        /**
         * Configuration for InteractiveSolutions\Bernard
         */
        'bernard_consumer_manager' => [
            'factories' => [
                SendEmail::class => SendEmailFactory::class,
            ],
        ],
    ],
];
