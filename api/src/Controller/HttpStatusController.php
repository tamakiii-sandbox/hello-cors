<?php
namespace App\Controller;

class HttpStatusController
{
    public function notFound()
    {
        return 'not found 404';
    }

    public function internalServerError()
    {
        return 'server error 500';
    }
}