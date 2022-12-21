<?php

namespace Web\Controllers\Http;

use Web\Services\Game\CharService;
use Web\Services\Game\StatusService;

class GameController extends BaseContoller
{
    public function chars()
    {
        try {
            [$data, $error] = $this->container->get(CharService::class)->list();

            if ($error) {
                throw new \Exception($error);
            }

            $this->jsonResponse($data);
        } catch (\Throwable $e) {
            return $this->jsonResponse(['message' => $e->getMessage()], 500);
        }
    }

    public function statuses()
    {
        try {
            [$data, $error] = $this->container->get(StatusService::class)->list();

            if ($error) {
                throw new \Exception($error);
            }

            $this->jsonResponse($data);
        } catch (\Throwable $e) {
            $this->jsonResponse(['message' => $e->getMessage()], 500);
        }
    }

    public function addCharStatus()
    {
        try {
            $charName = data_get($this->request->get, '[charName]');
            $statusesNames = explode(',', data_get($this->request->get, '[statusesNames]', ''));
            [$data, $error] = $this->container->get(CharService::class)->addCharWithStatuses($charName, $statusesNames);

            if ($error) {
                throw new \Exception($error);
            }

            $this->jsonResponse($data);
        } catch (\Throwable $e) {
            $this->jsonResponse(['message' => $e->getMessage()], 500);
        }
    }
}
