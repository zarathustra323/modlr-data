<?php

namespace Zarathustra\ModlrData\Api;

interface SerializerInterface
{
    /**
     * Serializes a Resource object into an API payload.
     *
     * @param   Resource    $resource
     * @return  string      The serialized payload for use in an API response.
     */
    public function serialize(Resource $resource);

    /**
     * Extracts an API payload into a Resource object.
     *
     * @param   string      $payload
     * @return  Resource    The extracted Resource object.
     */
    public function extract($payload);
}
