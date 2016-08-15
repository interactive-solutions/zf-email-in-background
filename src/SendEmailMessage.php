<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\EmailInBackground;

use InteractiveSolutions\Bernard\Message\AbstractExplicitMessage;

final class SendEmailMessage extends AbstractExplicitMessage
{
    /**
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $email;

    /**
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $template;

    /**
     * @Serializer\Type("array")
     *
     * @var array
     */
    private $payload;

    /**
     * SendNewPasswordEmailMessage constructor.
     * @param string $email
     * @param string $template
     * @param array $payload
     */
    public function __construct(string $email, string $template, array $payload)
    {
        $this->email    = $email;
        $this->template = $template;
        $this->payload  = $payload;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return SendEmail::class;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    public function getQueue(): string
    {
        return 'emails';
    }
}
