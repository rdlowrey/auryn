
namespace Auryn;

class ReflectionCacheApc implements ReflectionCacheInterface
{
    private localCache;
    private timeToLive = 5;

    public function __construct(<ReflectionCacheInterface> localCache = null)
    {
        if typeof localCache != "null" {
            let this->localCache = localCache;
        } else {
            let this->localCache = new ReflectionCacheArray();
        }
    }

    public function setTimeToLive(int seconds) -> <ReflectionCacheInterface>
    {
        if seconds > 0 {
            let this->timeToLive = seconds;
        }
        return this;
    }

    public function $fetch(string! key)
    {
        var localData;
        let localData = this->localCache->$fetch(key);

        if localData {
            return localData;
        }

        if apc_exists(key) {
            return apc_fetch(key);
        }

        return false;
    }

    public function store(string! key, var data) -> <ReflectionCacheInterface>
    {
        this->localCache->store(key, data);
        apc_store(key, data, this->timeToLive);
        return this;
    }
}
