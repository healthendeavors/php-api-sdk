<?php

namespace Hendeavors\Model;

/**
 * @todo convert timestamps to carbon
 */
class ExternalPlatformCallback
{
    private $model;

    public function __construct($resource)
    {
        $this->model = $resource;
    }

    public function id()
    {
        return (int)$this->model->id;
    }

    public function userId()
    {
        return $this->model->parentoauthuserid;
    }

    public function endPoint()
    {
        return $this->model->callbackendpoint ?? "";
    }

    public function httpMethod()
    {
        return $this->model->httpmethod ?? "";
    }

    public function requiredParameters()
    {
        return json_decode($this->model->requiredparameters);
    }

    public function addedAt()
    {
        return $this->model->addedat;
    }

    public function deletedAt()
    {
        return $this->model->deletedat;
    }
}
