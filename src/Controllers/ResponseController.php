<?php
declare(strict_types=1);

namespace App\Controllers;

class ResponseController
{
    /**
     * @param array $response
     *
     * @return string
     */
    public static function returnSuccess(array $response): string
    {
        $result = json_encode(['response' => $response]);
        echo $result;

        return $result;
    }

    /**
     * @param int    $httpStatus
     * @param string $errorMessage
     *
     * @return string
     */
    public static function returnError(int $httpStatus, string $errorMessage): string
    {
        http_response_code($httpStatus);

        $result = json_encode(array(
            'error' => true,
            'errorMessage' => $errorMessage
        ));
        echo $result;

        return $result;
    }

    /**
     * @return array|mixed
     */
    protected static function getInputData(): array
    {
        $body = file_get_contents('php://input');

        $data = json_decode((string)$body, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            self::returnError(400, 'Json error: ' . json_last_error());
        }

        return $data ?? [];
    }

    /**
     * @param string $headerName
     *
     * @return string|null
     */
    protected static function getHeader(string $headerName): ?string
    {
        $header = getallheaders()[$headerName] ?? null;

        return $header ? (string)$header : null;
    }
}
