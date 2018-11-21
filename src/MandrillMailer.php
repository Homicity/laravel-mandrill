<?php

namespace Homicity\MandrillMailable;

use Homicity\MandrillMailable\Facades\MandrillMessage;

class MandrillMailer
{
    /**
     * @var \Mandrill
     */
    public $mandrillMessage;

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

    /**
     * Email address to send message to
     *
     * @param $to
     * @return $this
     */
    public function to($to)
    {
        $this->to = $to;

        return $this;
    }

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
        $message = array(
            'subject' => $this->subject,
            'from_email' => $this->from,
            'from_name' => $this->fromName,
            'to' => array(
                array(
                    'email' => $this->to,
                    'name' => $this->name,
                )
            ),
            'important' => false,
            'merge' => true,
            'merge_language' => 'handlebars',
            'global_merge_vars' => $this->mergeTags,
            'merge_vars' => $this->mergeTags,
        );

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