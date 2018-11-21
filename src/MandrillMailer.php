<?php

namespace Homicity\MandrillMailable;

use Homicity\MandrillMailable\Facades\MandrillMessage;

class MandrillMailer
{
    private $message = [
        'to' => [
            'name'  => '',
            'email' => '',
        ],
    ];

    /**
     * @var
     */
    private $to;

    /**
     * @var
     */
    private $name;

    /**
     * @var
     */
    private $template;

    /**
     * @var
     */
    private $subject;

    /**
     * @var
     */
    private $from;

    /**
     * @var
     */
    private $fromName;

    /**
     * @var
     */
    private $mergeTags;

    /**
     * MandrillMailer constructor.
     */
    public function __construct()
    {

    }


    public function __call($method, $args)
    {
        // $this->to()->name();

        if ($method == 'to') {
            $this->message['to']['email'] = $args[0];
            return $this;
        }

        if ($method == 'name') {
            $this->message['to']['name'] = $args[0];
            return $this;
        }

        if (array_key_exists(snake_case($method), $this->message)) {
            return $this->message[$method] = $args[0];
            return $this;
        }
    }

    public function __get($attribute)
    {
        if ($attribute == 'message') {
            return $this->message;
        }
    }

//    /**
//     * Email address to send message to
//     *
//     * @param $to
//     * @return $this
//     */
//    public function to($to)
//    {
//        $this->to = $to;
//
//        return $this;
//    }

    /**
     * Name of recipient of message
     *
     * @param $name
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Merge Tags for the dynamic content of the message
     * format [
     *      'name'      => 'name of merge tag',
     *      'content'   => 'content of the merge tag'
     * ]
     *
     *
     * @param array $mergeTags
     * @return MandrillMailer
     */
    public function mergeTags(array $mergeTags = [])
    {
        $this->mergeTags = $mergeTags;

        return $this;
    }

    /**
     * Name of the mandrill template
     *
     * @param $template
     * @return $this
     */
    public function template($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Subject of the message
     *
     * @param $subject
     * @return $this
     */
    public function subject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Email address of sender
     *
     * @param $from
     * @return $this
     */
    public function from($from)
    {
        $this->from = $from ?? config('mandrill.from_email');

        return $this;
    }

    /**
     * Name of the sender
     *
     * @param $fromName
     * @return $this
     */
    public function fromName($fromName)
    {
        $this->fromName = $fromName ?? config('mandrill.from_name');

        return $this;
    }

    /**
     * Send the message
     *
     * @return mixed
     */
    public function send()
    {
        // $this->from();
        // $this->fromName();
        // $this->fromEmail();
        $message = [
            'subject'           => $this->subject,
            'from_email'        => $this->from,
            'from_name'         => $this->fromName,
            'to'                => [
                [
                    'email' => $this->to,
                    'name'  => $this->name,
                ],
            ],
            'important'         => false,
            'merge'             => true,
            'merge_language'    => 'handlebars',
            'global_merge_vars' => $this->mergeTags,
            'merge_vars'        => $this->mergeTags,
        ];

        return MandrillMessage::sendTemplate(
            $this->template,
            $this->mergeTags,
            $message,
            false,
            '',
            date('Y-m-d H:i:s')
        );
    }
}