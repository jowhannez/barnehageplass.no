<?php

namespace tibe\cachebuster\variables;

use Craft;

class CachebusterVariable
{
    public function get($path)
    {
        $manifest = $this->getManifest();
        foreach (array_keys($manifest) as $key) {
            if (is_numeric(strpos($path, $key))) {
                return $this->buildPath($manifest[$key]);
            }
        }

        return $this->buildPath($path) . '?t=' . time();
    }

    public function buildPath($path)
    {
        return Craft::alias('@web/resources' . $path);
    }

    public function getManifest()
    {
        $filepath = Craft::getAlias(CRAFT_BASE_PATH . '/mix-manifest.json');

        $manifest = [];
        if (file_exists($filepath)) {
            if ($content = file_get_contents($filepath)) {
                $json = json_decode($content);
                if (is_object($json)) {
                    $manifest = (array) $json;
                }
            }
        }

        return $manifest;
    }
}