<?php

namespace Spatie\LaravelEndpointResources;

use Spatie\LaravelEndpointResources\EndpointTypes\EndpointType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

final class EndpointResource extends JsonResource
{
    use StoresEndpointTypes;

    /** @var \Illuminate\Support\Collection */
    private $endPointTypes;

    /** @var \Illuminate\Database\Eloquent\Model */
    private $model;

    public function __construct(Model $model = null)
    {
        parent::__construct($model);

        $this->endPointTypes = new Collection();
        $this->model = $model;
    }

    public function toArray($request)
    {
        return $this->endPointTypes->mapWithKeys(function (EndPointType $endpointType) {
            return $endpointType->getEndpoints($this->model);
        });
    }
}
