<?php

App::uses('Shell', 'Console');

class CacheClearShell extends AppShell {
    public function main() {
        $config_list = Cache::configured();
        foreach ($config_list as $value) {
            echo 'clear ' . $value . "\n";
            Cache::clear(false, $value);
        }
        clearCache();
        echo "...done\n";
    }
}
