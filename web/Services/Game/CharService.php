<?php

namespace Web\Services\Game;

use RPG\Application\Status\AddStatusAction;
use RPG\Domain\Char\Char;
use RPG\Domain\Char\CharAttributes;
use RPG\Domain\Char\CharResistences;
use RPG\Domain\Char\CharXp;
use RPG\Domain\Status\Status;
use RPG\Domain\Status\StatusEffect;
use RPG\Infrastructure\Char\CharRepositoryPDO;
use Swoole\Coroutine\Channel;
use Web\Services\BaseService;

use function Swoole\Coroutine\go;

class CharService extends BaseService
{
    public function list(Channel $channel): void
    {
        go(function () use ($channel) {
            try {
                $charRepository = new CharRepositoryPDO($this->getPDOConn());
                $chars = $charRepository->list();

                $channel->push([$chars, false]);
            } catch (\Throwable $e) {
                // TODO: Log this... (monolog?)
                $channel->push([null, true]);
            }
        });
    }

    /**
     * @param string $charName
     * @param array $statusesName
     * @return array [data, error]
     */
    public function addCharWithStatuses(string $charName, array $statusesNames): array
    {
        try {
            $gameChars = get_fixture('chars.json', true);
            $gameStatuses = get_fixture('statuses.json', true);

            if (!$selectedChar = collection($gameChars)->findFirst(fn ($k, $v) => $k === $charName)) {
                throw new \Exception('Char not found... get chars on /game/chars');
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

            return [$char->toArray(), null];
        } catch (\Throwable $e) {
            return [null, $e->getMessage()];
        }
    }
}
