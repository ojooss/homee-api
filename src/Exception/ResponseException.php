<?php

namespace HomeeApi\Exception;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ResponseException extends Exception implements HomeeApiException
{

    public ResponseInterface $response;

    public function __construct(
        ResponseInterface $response,
        ?string           $message = null,
        ?int              $code = null,
        ?Throwable        $previous = null
    ) {
        parent::__construct(
            ($message != null ? $message : $response->getReasonPhrase()),
            ($code != null ? $code : $response->getStatusCode()),
            $previous);
        $this->response = $response;
    }

}
