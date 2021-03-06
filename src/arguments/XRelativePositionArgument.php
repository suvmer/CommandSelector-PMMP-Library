<?php

namespace selector\arguments;

use pocketmine\command\CommandSender;

class XRelativePositionArgument extends BaseArgument {

    public function getArgument() : string {
        return "dx";
    }

    public function selectEntities(CommandSender $sender, string $argument, array $arguments, array $entities) : array {
        return $entities;
    }
}