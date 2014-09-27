
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
        let this->timeToLive = (seconds > 0) ? seconds : this->timeToLive;
        return this;
    }

    public function $fetch(string! key)
    {
        var localData;
        let localData = this->localCache->$fetch(key);

        if !localData {
            return localData;
        } else {
            return apc_exists(key) ? apc_fetch(key) : false;
        }
    }

    public function store(string! key, var data) -> <ReflectionCacheInterface>
    {
        this->localCache->store(key, data);
        apc_store(key, data, this->timeToLive);
        return this;
    }
}
