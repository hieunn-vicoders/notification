<?php

namespace VCComponent\Laravel\Notification\Notifications\Messages;

class WebpressMessage
{
    private $toAddress;

    private $fromAddress;

    private $fromName;

    private $subjectContent;

    private $templateName;

    private $fields;

    public function to($address)
    {
        $this->toAddress = $address;
        return $this;
    }

    public function from($from_name, $from_address = '')
    {
        $this->fromName    = $from_name;
        $this->fromAddress = $from_address;
        return $this;
    }

    public function bcc($bcc)
    {
        $this->bcc = $bcc;
        return $this;
    }

    public function subject($subject)
    {
        $this->subjectContent = $subject;
        return $this;
    }

    public function template($template)
    {
        $this->templateName = $template;
        return $this;
    }

    public function mergeFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function buildParams()
    {
        return [
            'to'            => $this->toAddress,
            'from_address'  => $this->fromAddress,
            'from_name'     => $this->fromName,
            'subject'       => $this->subjectContent,
            'template_name' => $this->templateName,
            'merge_fields'  => $this->fields,
        ];
    }
}
