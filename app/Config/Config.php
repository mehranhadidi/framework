<?php

namespace App\Config;

use App\Config\Loaders\Loader;

class Config
{
    protected $config = [];
    protected $cache = [];

    public function load(array $loaders)
    {
        foreach ($loaders as $loader) {
            if(! $loader instanceof Loader)
                continue;

            $this->config = array_merge($this->config, $loader->parse());
        }

        return $this;
    }

    /**
     * Get a key from configs
     *
     * @param $key
     * @param $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if($this->existsInCache($key))
            return $this->fromCache($key);

        return $this->addToCache(
            $key,
            $this->extractFromConfig($key) ?? $default
        );
    }

    /**
     * Extract a key from configs
     *
     * @param $key
     * @return array|mixed|void
     */
    public function extractFromConfig($key)
    {
        $filtered = $this->config;

        foreach (explode('.', $key) as $segment) {
            if($this->exists($filtered,$segment)) {
                $filtered = $filtered[$segment];
                continue;
            }

            return;
        }

        return $filtered;
    }

    /**
     * Add a pair key-value to cache
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function addToCache($key, $value)
    {
        $this->cache[$key] = $value;

        return $value;
    }

    /**
     * Check if a key exists on cache
     *
     * @param $key
     * @return bool
     */
    public function existsInCache($key)
    {
        return isset($this->cache[$key]);
    }

    /**
     * Get a key from cache
     *
     * @param $key
     * @return mixed
     */
    public function fromCache($key)
    {
        return $this->cache[$key];
    }

    /**
     * Check if a key exists
     *
     * @param $config
     * @param $key
     * @return bool
     */
    public function exists($config, $key)
    {
        if(! is_array($config)) return false;

        return array_key_exists($key, $config);
    }
}