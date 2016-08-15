InteractiveSolutions\EmailInBackground
======================================

This is a integration module between `RoaveEmailTemplates` and `InteractiveSolutions\ZfBernard`
and it allow a very simple method of sending emails in the background.


# Installation

Simple installation via composer

`composer require interactive-solutions/zf-email-in-background`

# Configuration

None, it's already handled for you by the module

# Usage

Assuming you have access to the bernard producer `InteractiveSolutions\Bernard\Producer` you simply
want to produce a new message that is an instance of `InteractiveSolutions\EmailInBackground\SendEmailMessage`

Example
```php
$args = [
    'activationKey' => 'helloWorld'
];

$producer->producer(new SendEmailMessage('email@google.com', 'user:registration', $args));
```

And voila, you have producer a new message that will send an email in a background task

# Running the code in development

Run this command in a terminal for the application root

`php public/index.php interactive-solutions:bernard:consume emails`

# Running the code in production

When running in production you either want a docker container that is running the consume command
or have a supervisord process running it. 

Example supervisor configuration
```
[program:emails-in-background]
command=php <path to app root>/public/index.php interactive-solutions:bernard:consume emails
autostart=true
autorestart=true
stderr_logfile=<path to app root>/data/logs/supervisor/emails.err.log
stdout_logfile=<path to app root>/data/logs/supervisor/emails.out.log
user=www-data
group=www-data
```

