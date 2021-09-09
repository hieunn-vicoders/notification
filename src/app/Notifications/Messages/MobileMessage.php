<?php

namespace VCComponent\Laravel\Notification\Notifications\Messages;

class MobileMessage
{
    private $user_id;
    private $header = [];
    private $content = [];
    private $url = "";
    private $data = [];

    public function to($user_id)
    {
        $this->user_id = $user_id;
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
            'to'            => $this->user_id,
            'headers'       => ['en' => $this->header],
            'contents'      => ['en' => $this->content],
            'url'           => $this->url,
            'data'          => $this->data,
        ];
    }
}
