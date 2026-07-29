<?php

namespace BrandForge\Exceptions;

class GodmodeApiException extends \RuntimeException
{
    private int $statusCode;
    private array $responseBody;

    public function __construct(string $message, int $statusCode = 0, array $responseBody = [], ?\Throwable $previous = null)
    {
        parent::__construct($message, $statusCode, $previous);
        $this->statusCode = $statusCode;
        $this->responseBody = $responseBody;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getResponseBody(): array
    {
        return $this->responseBody;
    }
}

class GodmodeConnectionException extends GodmodeApiException {}

class GodmodeAuthException extends GodmodeApiException {}

class GodmodeTimeoutException extends GodmodeApiException {}
