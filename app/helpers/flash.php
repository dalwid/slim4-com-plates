<?php

use app\classes\Flash;

function getFlash(string $key)
{
    $flash = Flash::get($key);
    return isset($flash['message']) ? "<div class='text-center  alert alert-{$flash['alert']}' role='alert'>{$flash['message']}</div>": '';
}

function old(string $key)
{
    $flash = Flash::get('old_' . $key);
    return $flash['message'] ?? ''; 
}