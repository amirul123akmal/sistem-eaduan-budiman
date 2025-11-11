<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class ProjectBApiService
{
    protected string $baseUrl;
    protected string $apiToken;
    protected int $timeout;

    public function __construct()
    {
        $this->baseUrl = config('services.project_b.url');
        $this->apiToken = config('services.project_b.token');
        $this->timeout = config('services.project_b.timeout', 30);
    }

    /**
     * Make GET request to Project B API
     */
    public function get(string $endpoint, array $params = []): array
    {
        try {
            $response = Http::timeout($this->timeout)
                ->withToken($this->apiToken)
                ->get($this->baseUrl . '/' . ltrim($endpoint, '/'), $params);

            $this->logApiCall('GET', $endpoint, $params, $response->status(), $response->json());

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                    'status' => $response->status(),
                ];
            }

            return [
                'success' => false,
                'error' => $response->json()['message'] ?? 'API request failed',
                'status' => $response->status(),
            ];
        } catch (Exception $e) {
            $this->logApiCall('GET', $endpoint, $params, 0, ['error' => $e->getMessage()]);
            
            return [
                'success' => false,
                'error' => 'Connection error: ' . $e->getMessage(),
                'status' => 0,
            ];
        }
    }

    /**
     * Make POST request to Project B API
     */
    public function post(string $endpoint, array $data = []): array
    {
        try {
            $response = Http::timeout($this->timeout)
                ->withToken($this->apiToken)
                ->post($this->baseUrl . '/' . ltrim($endpoint, '/'), $data);

            $this->logApiCall('POST', $endpoint, $data, $response->status(), $response->json());

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                    'status' => $response->status(),
                ];
            }

            return [
                'success' => false,
                'error' => $response->json()['message'] ?? 'API request failed',
                'status' => $response->status(),
            ];
        } catch (Exception $e) {
            $this->logApiCall('POST', $endpoint, $data, 0, ['error' => $e->getMessage()]);
            
            return [
                'success' => false,
                'error' => 'Connection error: ' . $e->getMessage(),
                'status' => 0,
            ];
        }
    }

    /**
     * Make PUT request to Project B API
     */
    public function put(string $endpoint, array $data = []): array
    {
        try {
            $response = Http::timeout($this->timeout)
                ->withToken($this->apiToken)
                ->put($this->baseUrl . '/' . ltrim($endpoint, '/'), $data);

            $this->logApiCall('PUT', $endpoint, $data, $response->status(), $response->json());

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                    'status' => $response->status(),
                ];
            }

            return [
                'success' => false,
                'error' => $response->json()['message'] ?? 'API request failed',
                'status' => $response->status(),
            ];
        } catch (Exception $e) {
            $this->logApiCall('PUT', $endpoint, $data, 0, ['error' => $e->getMessage()]);
            
            return [
                'success' => false,
                'error' => 'Connection error: ' . $e->getMessage(),
                'status' => 0,
            ];
        }
    }

    /**
     * Make DELETE request to Project B API
     */
    public function delete(string $endpoint): array
    {
        try {
            $response = Http::timeout($this->timeout)
                ->withToken($this->apiToken)
                ->delete($this->baseUrl . '/' . ltrim($endpoint, '/'));

            $this->logApiCall('DELETE', $endpoint, [], $response->status(), $response->json());

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                    'status' => $response->status(),
                ];
            }

            return [
                'success' => false,
                'error' => $response->json()['message'] ?? 'API request failed',
                'status' => $response->status(),
            ];
        } catch (Exception $e) {
            $this->logApiCall('DELETE', $endpoint, [], 0, ['error' => $e->getMessage()]);
            
            return [
                'success' => false,
                'error' => 'Connection error: ' . $e->getMessage(),
                'status' => 0,
            ];
        }
    }

    /**
     * Log API calls for auditing
     */
    protected function logApiCall(string $method, string $endpoint, array $payload, int $status, $response): void
    {
        Log::channel('api')->info('Project B API Call', [
            'method' => $method,
            'endpoint' => $endpoint,
            'payload' => $payload,
            'status' => $status,
            'response' => $response,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}

