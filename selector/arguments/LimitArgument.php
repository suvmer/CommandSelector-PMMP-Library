<?php

namespace selector\arguments;

use pocketmine\command\CommandSender;

class LimitArgument extends BaseArgument {
    
    public function getArgument() : string {
        return "c";
    }

    public function selectgetEntities(CommandSender $sender, string $argument, array $arguments, array $entities) : array {
        $array = [];
        $value = $this->getValue($argument);
        if (!ctype_digit($value)) {
            return [];
        }
        $limit = intval($value);

        if ($limit < 0) {
            $limit *= -1;
            $entities = array_reverse($entities);
        }

        foreach ($entities as $entity) {
            $array[] = $entity;

            if (count($array) >= $limit) {
                break;
            }
        }
        
        return $array;
    }
}