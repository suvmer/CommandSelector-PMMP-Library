<?php

namespace selector\arguments;

use pocketmine\Player;

use pocketmine\command\CommandSender;

class EntityTypeArgument extends BaseArgument {
    
    public function getArgument() : string {
        return "type";
    }

    public function selectEntities(CommandSender $sender, string $argument, array $arguments, array $entities) : array {
        $array = [];
        $value = $this->getValue($argument);
        $exclud = $this->isExcluded($argument);
        if (!is_numeric($value)) {
            return [];
        }
        $type = intval($value);

        foreach ($entities as $entity) {
            $id = $entity::NETWORK_ID;
            if ($entity instanceof Player) {
                $id = 63;
            }

            if ($id == $type && !$exclud) {
                $array[] = $entity;
                continue;
            }
            if ($id != $type && $exclud) {
                $array[] = $entity;
            }
        }
        
        return $array;
    }
}