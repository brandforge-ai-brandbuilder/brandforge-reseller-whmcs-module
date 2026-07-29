<?php

namespace BrandForge;

class Logger
{
    private bool $debugMode;
    private string $moduleName = 'brandforge';

    public function __construct(bool $debugMode = false)
    {
        $this->debugMode = $debugMode;
    }

    /**
     * Log an API call via WHMCS logModuleCall().
     */
    public function logApiCall(
        string $action,
        array $requestData,
        $response,
        array $replacements = []
    ): void {
        if (function_exists('logModuleCall')) {
            logModuleCall(
                $this->moduleName,
                $action,
                $requestData,
                $response,
                $response,
                $replacements
            );
        }
    }

    /**
     * Write a debug entry to the WHMCS module log only when debug mode is on.
     */
    public function debug(string $message, array $context = []): void
    {
        if (!$this->debugMode) {
            return;
        }

        $this->logApiCall('DEBUG:' . $message, $context, '');
    }
}
