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
    public function returnSuccess(array $response): string
    {
        return json_encode(['response' => $response]);
    }

    /**
     * @param int $httpStatus
     * @param     $errorMessage
     *
     * @return string
     */
    public function returnError(int $httpStatus, $errorMessage): string
    {
        http_response_code($httpStatus);

        return json_encode(array(
            'error' => true,
            'errorMessage' => $errorMessage
        ));
    }
}
