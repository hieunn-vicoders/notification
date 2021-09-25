<?php

namespace VCComponent\Laravel\Notification\Notifications\Messages;

use stdClass;

class MobileMessage
{
    private $emails = [];
    private $header;
    private $content;
    private $url;
    private $data;

    public function ToEmail($emails)
    {
        $this->emails = $emails;
        return $this;
    }

    public function header($header)
    {
        $this->header = $header;
        return $this;
    }

    public function content($content)
    {
        $this->content = $content;
        return $this;
    }

    public function url($url)
    {
        $this->url = $url;
        return $this;
    }

    public function data($data)
    {
        $this->data = $data;
        return $this;
    }

    public function buildParams()
    {
        return [
            'email'         => $this->emails,
            'headers'       => ['en' => $this->header],
            'contents'      => ['en' => $this->content],
            'url'           => $this->url,
            'data'          => $this->data,
        ];
    }
}
