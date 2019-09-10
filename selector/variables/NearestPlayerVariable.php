<?php

namespace selector\variables;

use pocketmine\command\CommandSender;

use pocketmine\level\Position;


use selector\arguments\LimitArgument;

class NearestPlayerVariable implements IVariable {

    public function getVariable() : string {
        return "p";
    }

    public function getEntities(CommandSender $sender, string $args, array $arguments) : array {
        if (!($sender instanceof Position)) {
            return [];
        }

        $players = $sender->getLevel()->getPlayers();
        if (count($players) == 0) {
            return [];
        }

        uasort($players, function($a, $b) {
            return $sender->distanceSquared($a) - $sender->distanceSquared($b);
        });

        $limit = 1;
        foreach ($arguments as $argument) {
            if ($argument instanceof LimitArgument) {
                $limit = $argument->getValue($argument);
            }
        }

        $target = [];
        foreach ($players as $player) {
            $target[] = $player;
            if (count($target) >= $limit) {
                break;
            }
        }

        return $target;
    }
}