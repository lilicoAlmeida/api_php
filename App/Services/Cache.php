
<?php
class Cache {
    private $cacheDir = __DIR__ . '/cache/';

    public function get($key) {
        $cacheFile = $this->cacheDir . sha1($key) . '.cache';
        if (file_exists($cacheFile)) {
            return unserialize(file_get_contents($cacheFile));
        }
        return null;
    }

    public function set($key, $data, $duration = 3600) {
        $cacheFile = $this->cacheDir . sha1($key) . '.cache';
        file_put_contents($cacheFile, serialize($data));
    }
}
?>
