<?php

function redirect($response, $to, $status = 302)
{
    return $response->withHeader('Location', $to)->withStatus($status);
}