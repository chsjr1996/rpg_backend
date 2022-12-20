<?php

namespace Web\Controllers\Http;

use RPG\Application\Status\AddStatusAction;
use RPG\Domain\Char\Char;
use RPG\Domain\Char\CharAttributes;
use RPG\Domain\Char\CharResistences;
use RPG\Domain\Char\CharXp;
use RPG\Domain\Status\Status;
use RPG\Domain\Status\StatusEffect;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Server;

class GameController extends BaseContoller
{
    public function chars(Request $request, Response $response, Server $server)
    {
        $chars = array_keys(get_fixture('chars.json', true));
        $this->jsonResponse($response, $chars);
    }

    public function statuses(Request $request, Response $response, Server $server)
    {
        $statuses = array_keys(get_fixture('statuses.json', true));
        $this->jsonResponse($response, $statuses);
    }

    public function addCharStatus(Request $request, Response $response, Server $server)
    {
        try {
            $charName = data_get($request->get, '[charName]');
            $statusesNames = explode(',', data_get($request->get, '[statusesNames]', ''));

            $gameChars = get_fixture('chars.json', true);
            $gameStatuses = get_fixture('statuses.json', true);

            if (!$selectedChar = collection($gameChars)->findFirst(fn ($k, $v) => $k === $charName)) {
                $this->jsonResponse($response, ['message' => 'Char not found... get chars on /game/chars'], 404);
            }

            $charXp = CharXp::makeFromArray((array) $selectedChar->xp);
            $charAttributes = CharAttributes::makeFromArray((array) $selectedChar->attributes);
            $charResistences = CharResistences::makeFromArray((array) $selectedChar->resistences);
            $char = Char::withData($charName, $charXp, $charAttributes, $charResistences, [], []);
            $selectedStatuses = [];

            foreach ($statusesNames as $statusName) {
                $selectedStatus = collection($gameStatuses)->findFirst(fn ($k, $v) => $k === $statusName);

                if ($selectedStatus) {
                    $selectedEffects = [];

                    foreach ((array) $selectedStatus->effects as $effect) {
                        $selectedEffects[] = StatusEffect::makeFromArray((array) $effect);
                    }

                    $selectedStatuses[$statusName] = Status::makeFromArray(['name' => $statusName, 'effects' => $selectedEffects]);
                }
            }

            $useCase = new AddStatusAction();
            $useCase->execute($char, $selectedStatuses);

            $this->jsonResponse($response, $char->toArray());
        } catch (\Throwable $e) {
            $this->jsonResponse($response, ['message' => $e->getMessage()], 500);
        }
    }
}
