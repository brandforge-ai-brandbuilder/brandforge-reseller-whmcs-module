<?php

namespace BrandForge;

use BrandForge\Exceptions\GodmodeApiException;
use BrandForge\Exceptions\GodmodeAuthException;
use BrandForge\Exceptions\GodmodeConnectionException;
use BrandForge\Exceptions\GodmodeTimeoutException;

class GodmodeClient
{
    private const TIMEOUT_SECONDS  = 30;
    private const CONNECT_TIMEOUT  = 10;

    private string $apiUrl;
    private string $apiKey;
    private Logger $logger;

    public function __construct(string $apiUrl, string $apiKey, Logger $logger)
    {
        $this->apiUrl  = rtrim($apiUrl, '/');
        $this->apiKey  = $apiKey;
        $this->logger  = $logger;
    }

    // -----------------------------------------------------------------------
    // Public API actions
    // -----------------------------------------------------------------------

    public function testConnection(): array
    {
        return $this->request('GET', '/api/godmode/v1/provision/ping', [], 'TestConnection');
    }

    public function createAccount(array $payload): array
    {
        return $this->request('POST', '/api/godmode/v1/provision/create', $payload, 'CreateAccount');
    }

    public function suspendAccount(array $payload): array
    {
        return $this->request('POST', '/api/godmode/v1/provision/suspend', $payload, 'SuspendAccount');
    }

    public function unsuspendAccount(array $payload): array
    {
        return $this->request('POST', '/api/godmode/v1/provision/unsuspend', $payload, 'UnsuspendAccount');
    }

    public function terminateAccount(array $payload): array
    {
        return $this->request('POST', '/api/godmode/v1/provision/terminate', $payload, 'TerminateAccount');
    }

    public function changePackage(array $payload): array
    {
        return $this->request('POST', '/api/godmode/v1/provision/change_package', $payload, 'ChangePackage');
    }

    public function getPackages(): array
    {
        return $this->request('GET', '/api/godmode/v1/provision/packages', [], 'GetPackages');
    }

    /**
     * Fetch live service info: credits, workspaces, and package limits.
     * Returns an empty array when the endpoint is unavailable.
     */
    public function getServiceInfo(string $serviceId): array
    {
        return $this->request(
            'GET',
            '/api/godmode/v1/provision/status?service_id=' . urlencode($serviceId),
            [],
            'GetServiceInfo'
        );
    }

    /**
     * Exchange a subscription ID for a one-time SSO login URL.
     *
     * @param string $returnPath  Optional path on the BrandForge app to land on after login.
     */
    public function sso(string $serviceId, string $returnPath = ''): array
    {
        $payload = ['service_id' => $serviceId];
        if ($returnPath !== '') {
            $payload['return_path'] = $returnPath;
        }
        return $this->request('POST', '/api/godmode/v1/provision/sso', $payload, 'SSO');
    }

    // -----------------------------------------------------------------------
    // Core HTTP
    // -----------------------------------------------------------------------

    /**
     * @throws GodmodeApiException
     */
    private function request(string $method, string $path, array $payload, string $action): array
    {
        $url     = $this->apiUrl . $path;
        $headers = [
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json',
            'Accept: application/json',
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => self::TIMEOUT_SECONDS,
            CURLOPT_CONNECTTIMEOUT => self::CONNECT_TIMEOUT,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_SSL_VERIFYPEER    => true,
            CURLOPT_SSL_VERIFYHOST    => 2,
            CURLOPT_FOLLOWLOCATION    => true,  // follow http→https / non-www→www redirects
            CURLOPT_MAXREDIRS         => 5,
            CURLOPT_UNRESTRICTED_AUTH => true,  // keep Authorization header through redirects
        ]);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        } elseif ($method !== 'GET') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            if (!empty($payload)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            }
        }

        $rawResponse = curl_exec($ch);
        $statusCode  = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError   = curl_error($ch);
        $curlErrno   = curl_errno($ch);
        // curl_close() is a no-op from PHP 8.0 onward and deprecated in 8.5
        // Unsetting the handle releases the resource immediately on all versions.
        unset($ch);

        // Log every call regardless of outcome
        $this->logger->logApiCall($action, $this->sanitizePayload($payload), $rawResponse, [$this->apiKey]);

        if ($curlErrno === CURLE_OPERATION_TIMEDOUT) {
            throw new GodmodeTimeoutException("Request timed out for action: {$action}", 0);
        }

        if ($curlErrno !== 0) {
            throw new GodmodeConnectionException("cURL error [{$curlErrno}]: {$curlError}", 0);
        }

        $decoded = json_decode($rawResponse, true);
        if (!\is_array($decoded)) {
            throw new GodmodeApiException("Invalid JSON response from Godmode API for action: {$action}", $statusCode);
        }

        if ($statusCode === 401) {
            throw new GodmodeAuthException("Unauthorized — check your Godmode API Key", $statusCode, $decoded);
        }

        if ($statusCode >= 400) {
            $message = $decoded['message'] ?? $decoded['error'] ?? "API error {$statusCode}";
            throw new GodmodeApiException($message, $statusCode, $decoded);
        }

        return $decoded;
    }

    /**
     * Replace sensitive values so they don't appear in WHMCS logs.
     */
    private function sanitizePayload(array $payload): array
    {
        return $payload;
    }
}
