
namespace Auryn;

class ReflectionCacheMemcached implements ReflectionCacheInterface
{
    private localCache;
    private timeToLive = 5;
    private memcached;

    public function __construct(<\Memcached> memcached, <ReflectionCacheInterface> localCache = null)
    {
        let this->memcached = memcached;

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
        if localData != false {
            return localData;
        }

        let localData = this->memcached->get(key);
        if localData != false {
            return localData;
        }

        return false;
    }

    public function store(string! key, var data) -> <ReflectionCacheInterface>
    {
        this->localCache->store(key, data);
        this->memcached->set(key, data, this->timeToLive);
        return this;
    }
}
