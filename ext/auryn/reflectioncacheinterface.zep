
namespace Auryn;

interface ReflectionCacheInterface
{
    /**
     * @param string key
     */
    public function $fetch(string! key);

    /**
     * @param string key
     * @param array data
     */
    public function store(string! key, var data) -> <ReflectionCacheInterface>;
}
