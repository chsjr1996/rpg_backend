<?php

namespace Web\Controllers\Http;

class NotFoundController extends BaseContoller
{
    public function index()
    {
        $this->jsonResponse(['message' => 'not found'], 404);
    }
}
