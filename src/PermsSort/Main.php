<?php

declare(strict_types=1);

namespace PermsSort;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

/**
 * Class Main
 * @package PermsSort
 *
 * @author  celis <celishere@gmail.com> <Telegram:@celishere>
 * @version 1.0.0
 * @since   1.0.0
 */
class Main extends PluginBase {

    private $list = [];

    public function onLoad(): void {
        $this->saveResource('groups.yml');

        $preList = $this->getConfig()->get('groups');
        $this->list = explode(",", $preList);
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
    public function getGroupId(string $group): int {
        foreach ($this->list as $id => $value) {
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
    public function isGroupLow(string $group, string $newGroup): bool {
        return $this->getGroupId($group) < $this->getGroupId($newGroup) ? true : false;
    }
}