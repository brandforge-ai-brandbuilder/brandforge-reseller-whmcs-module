<?php

namespace BrandForge;

use BrandForge\Exceptions\GodmodeApiException;

class SsoHandler
{
    private GodmodeClient $client;

    public function __construct(GodmodeClient $client)
    {
        $this->client = $client;
    }

    /**
     * Obtain a one-time SSO login URL for the given service.
     *
     * If $frontendBaseUrl is supplied, the scheme+host returned by Godmode
     * is replaced with it so the customer lands on the reseller's branded
     * domain instead of brandforge.software.
     *
     * Example:
     *   Godmode returns: https://staging.brandforge.software/sso?token=xyz
     *   frontendBaseUrl: https://app.resellerdomain.com
     *   Result:          https://app.resellerdomain.com/sso?token=xyz
     *
     * @throws \RuntimeException   When the API returns no URL
     * @throws GodmodeApiException On API-level failures
     */
    public function getLoginUrl(
        string $serviceId,
        string $returnPath      = '',
        string $frontendBaseUrl = ''
    ): string {
        $response = $this->client->sso($serviceId, $returnPath);

        $data = $response['data'] ?? $response;
        $url  = $data['url'] ?? $data['login_url'] ?? $data['sso_url'] ?? '';

        if ($url === '') {
            throw new \RuntimeException(
                'Godmode SSO endpoint returned a successful response but no login URL was found.'
            );
        }

        // Godmode now returns user/entity/package/credits alongside the token.
        // Encode them as a base64url query param so the frontend can skip the
        // impersonate fallback entirely.
        $profile = [];
        foreach (['user', 'entity', 'package', 'credits'] as $key) {
            if (isset($data[$key]) && \is_array($data[$key])) {
                $profile[$key] = $data[$key];
            }
        }
        if (!empty($profile)) {
            $encoded  = rtrim(strtr(base64_encode(json_encode($profile, JSON_UNESCAPED_UNICODE)), '+/', '-_'), '=');
            $url     .= (strpos($url, '?') !== false ? '&' : '?') . 'profile=' . $encoded;
        }

        // Replace Godmode's host with the reseller's branded domain when configured.
        $frontendBaseUrl = rtrim(trim($frontendBaseUrl), '/');
        if ($frontendBaseUrl !== '') {
            $parsed       = parse_url($url);
            $pathAndQuery = ($parsed['path'] ?? '')
                . (isset($parsed['query'])    ? '?' . $parsed['query']    : '')
                . (isset($parsed['fragment']) ? '#' . $parsed['fragment'] : '');
            $url = $frontendBaseUrl . $pathAndQuery;
        }

        return $url;
    }
}
