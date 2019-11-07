<?php
namespace MyVendor\Weekday\Resource\Page;

use BEAR\Resource\ResourceObject;
use BEAR\Sunday\Inject\ResourceInject;

class Index extends ResourceObject
{
    use ResourceInject;

    /**
     * @param integer $year
     * @param integer $month
     * @param integer $day
     * @return ResourceObject
     */
    public function onGet(int $year, int $month, int $day) : ResourceObject
    {
        $params = get_defined_vars();
        $this->body = $params + [
            'weekday' => $this->resource->get('app://self/weekday', $params)
        ];

        return $this;
    }
}
