<?php

defined('TYPO3') or die();

(function () {
    $config = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)
        ->get('ses_mailer');

    if ($config['enabled']) {
        // build DSN from config
        $dsn = $config['method'] . '://';
        if (!empty($config['accessKey'])) {
            $dsn .= urlencode($config['accessKey']);
            if (!empty($config['secret'])) {
                $dsn .= ':' . urlencode($config['secret']);
            }
        }
        $dsn .= '@default';
        if (!empty($config['region'])) {
            $dsn .= '?region=' . urlencode($config['region']);
        }

        // Dangerous: Update LocalConfiguration.php file with TYPO3's @internal methods
        if ($GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport'] !== 'dsn' || $GLOBALS['TYPO3_CONF_VARS']['MAIL']['dsn'] !== $dsn) {
            $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport'] = 'dsn';
            $GLOBALS['TYPO3_CONF_VARS']['MAIL']['dsn'] = $dsn;
            $configurationManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ConfigurationManager::class);
            $localConfiguration = $configurationManager->getLocalConfiguration();
            $localConfiguration = \TYPO3\CMS\Core\Utility\ArrayUtility::setValueByPath($localConfiguration, 'MAIL/transport', 'dsn');
            $localConfiguration = \TYPO3\CMS\Core\Utility\ArrayUtility::setValueByPath($localConfiguration, 'MAIL/dsn', $dsn);
            $configurationManager->writeLocalConfiguration($localConfiguration);
        }
    }
})();
