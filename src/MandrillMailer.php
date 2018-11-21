<?php

namespace Homicity\MandrillMailable;

use Homicity\MandrillMailable\Facades\MandrillMessage;

class MandrillMailer
{
    /**
     * Message configurations.
     *
     * @var array
     */
    private $message;

    /**
     * Mandrill template name.
     *
     * @var string
     */
    private $template_name;

    /**
     *
     *
     * @var
     */
    private $template_content;


    /**
     * MandrillMailer constructor.
     */
    public function __construct()
    {
        $this->message = $this->getDefaultMessageStructure();
    }

    /**
     * Magically set all attributes
     *
     * @param $method
     * @param $args
     * @return $this
     */
    public function __call($method, $args)
    {
        if ($method == 'to') {
            $this->message['to'][0]['email'] = $args[0];
            return $this;
        }

        if ($method == 'name') {
            $this->message['to'][0]['name'] = $args[0];
            return $this;
        }

        if (array_key_exists(snake_case($method), $this->message)) {
            $this->message[snake_case($method)] = $args[0];
            return $this;
        }

        if (property_exists($this, snake_case($method))) {
            $this->{snake_case($method)} = $args[0];
            return $this;
        }
    }

    /**
     * Magically get the message array
     *
     * @param $attribute
     * @return array
     */
    public function __get($attribute)
    {
        if (property_exists($this, snake_case($attribute))) {
            return $this->{snake_case($attribute)};
        }
    }

    /**
     * Send the message
     *
     * @return mixed
     */
    public function send()
    {
        return MandrillMessage::sendTemplate(
            $this->template_name,
            $this->template_content,
            $this->message,
            $this->async,
            $this->ip_pool,
            $this->send_at
        );
    }

    /**
     * The default message structure for mandrill templates.
     *
     * @return array
     */
    private function getDefaultMessageStructure()
    {
        return [
            'subject'           => '',
            'from_email'        => config('mandrill.from_email'),
            'from_name'         => config('mandrill.from_name'),
            'to'                => [[
                'email' => '',
                'name'  => '',
                'type'  => 'to',
            ]],
            'important'         => false,
            'merge'             => true,
            'merge_language'    => 'handlebars',
            'global_merge_vars' => [],
            'merge_vars'        => [],
            'tags'              => [],
        ];
    }
}