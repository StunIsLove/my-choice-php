<?php
declare(strict_types=1);

namespace App\Controllers;

class ResponseController
{
    /**
     * @param array $response
     *
     * @return void
     */
    public static function returnSuccess(array $response): void
    {
        $result = json_encode(['response' => $response]);

        echo $result;
    }

    /**
     * @param int    $httpStatus
     * @param string $errorMessage
     *
     * @return void
     */
    public static function returnError(int $httpStatus, string $errorMessage): void
    {
        http_response_code($httpStatus);

        $result = json_encode(array(
            'error' => true,
            'errorMessage' => $errorMessage
        ));

        echo $result;
        die();
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
            die();
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
        $header = $_SERVER["HTTP_$headerName"] ?? null;

        return $header ? (string)$header : null;
    }
}
