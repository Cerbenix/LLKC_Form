<?php declare(strict_types=1);

namespace App\Core;

class ApiResponse
{
    private array $data;

    public function __construct(array $data, int $status = 200)
    {
        $this->data = $data;
        $this->setHttpResponseCode($status);
        $this->setJsonContentTypeHeader();
    }

    public function getData(): string
    {
        return json_encode($this->data);
    }

    private function setHttpResponseCode(int $status): void
    {
        if ($status < 100 || $status >= 600) {
            throw new \InvalidArgumentException('Invalid HTTP status code');
        }

        http_response_code($status);
    }

    private function setJsonContentTypeHeader(): void
    {
        header('Content-Type: application/json');
    }
}
