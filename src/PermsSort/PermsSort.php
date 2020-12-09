<?php

declare(strict_types=1);

namespace PermsSort;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

/**
 * Class PermsSort
 * @package PermsSort
 *
 * @author  celis <celishere@gmail.com> <Telegram:@celishere>
 * @version 1.0.1
 * @since   1.0.0
 */
class PermsSort extends PluginBase {

    private static $groups = [];

    public function onLoad(): void {
        $this->saveResource('groups.yml');

        $preList = $this->getConfig()->get('groups');
        self::$groups = explode(",", $preList);
    }

    /**
     * @return Config
     */
    public function getConfig(): Config {
        return new Config($this->getDataFolder() . 'groups.yml');
    }

    /**
     * @param string $group
     *
     * @return int
     */
    private static function getGroupId(string $group): int {
        foreach (self::$groups as $id => $value) {
            if ($value === $group) {
                return $id;
            }
        }

        return 0;
    }

    /**
     * @param string $group
     * @param string $newGroup
     *
     * @return bool
     */
    public static function isGroupLow(string $group, string $newGroup): bool {
        return self::getGroupId($group) < self::getGroupId($newGroup);
    }
}