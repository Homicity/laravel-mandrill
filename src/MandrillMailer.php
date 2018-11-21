<?php

namespace Homicity\MandrillMailable;

use Homicity\MandrillMailable\Facades\MandrillMessage;

class MandrillMailer
{
    /**
     * @var array
     */
    private $message = [
        'subject'           => '',
        'from_email'        => '',
        'from_name'         => '',
        'to'                => [
                                'email' => '',
                                'name' => '',
                                'type' => 'to'
                            ],
        'important'         => false,
        'merge'             => true,
        'merge_language'    => 'handlebars',
        'global_merge_vars' => [],
        'merge_vars'        => [],
        'tags'              => [],
    ];

    /**
     * @var
     */
    private $template_name;

    /**
     * @var
     */
    private $template_content;

    /**
     * @var
     */
    private $async;

    /**
     * @var
     */
    private $ip_pool;

    /**
     * @var
     */
    private $send_at;


    /**
     * MandrillMailer constructor.
     */
    public function __construct()
    {
        // Set the default values
        $this->message['from_email'] = config('mandrill.from_email');
        $this->message['from_name'] = config('mandrill.from_name');
        $this->send_at = date('Y-m-d H:i:s');
        $this->ip_pool = '';
        $this->async = false;
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
            $this->message['to']['email'] = $args[0];
            return $this;
        }

        if ($method == 'name') {
            $this->message['to']['name'] = $args[0];
            return $this;
        }

        if (array_key_exists(snake_case($method), $this->message)) {
            $this->message[snake_case($method)] = $args[0];
            return $this;
        }

        if(property_exists($this, snake_case($method))){
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
        if(property_exists($this, snake_case($attribute))) {
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
}