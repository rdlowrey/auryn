
namespace Auryn;

class ReflectionCacheArray implements ReflectionCacheInterface
{
    /**
     * @var array
     */
    private cache = [];

    /**
     * {@inheritDoc}
     */
    public function $fetch(string! key)
    {
        var value;
        if fetch value, this->cache[key] {
            return value;
        }
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function store(string! key, var data) -> <ReflectionCacheInterface>
    {
        let this->cache[key] = data;
        return this;
    }
}
