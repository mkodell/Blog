<?php

namespace App\Services;

interface Newsletter
{
    public function firstSubscribe(string $email, string $list = null);

    public function unsubscribe(string $email, string $list = null);

    public function checkStatus(string $email, string $list = null);

    public function resubscribe(string $email, string $list = null);
}
