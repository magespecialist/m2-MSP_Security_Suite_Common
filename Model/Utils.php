<?php
/**
 * MageSpecialist
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@magespecialist.it so we can send you a copy immediately.
 *
 * @category   MSP
 * @package    MSP_SecuritySuiteCommon
 * @copyright  Copyright (c) 2017 Skeeller srl (http://www.magespecialist.it)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace MSP\SecuritySuiteCommon\Model;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\DeploymentConfig;
use MSP\SecuritySuiteCommon\Api\UtilsInterface;

class Utils implements UtilsInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var DeploymentConfig
     */
    private $deploymentConfig;

    public function __construct(
        RequestInterface $request,
        DeploymentConfig $deploymentConfig
    ) {
        $this->request = $request;
        $this->deploymentConfig = $deploymentConfig;
    }

    /**
     * Get sanitized URI
     * @param null $uri
     * @return string
     */
    public function getSanitizedUri($uri = null)
    {
        if (is_null($uri)) {
            $uri = $this->request->getRequestUri();
        }

        $uri = filter_var($uri, FILTER_SANITIZE_URL);
        $uri = preg_replace('|/+|', '/', $uri);
        $uri = preg_replace('|^/index\.php|', '', $uri);

        return $uri;
    }

    /**
     * Return backend path
     * @return string
     */
    public function getBackendPath()
    {
        $backendConfigData = $this->deploymentConfig->getConfigData('backend');
        return $backendConfigData['frontName'];
    }

    /**
     * Return true if $uri is a backend URI
     * @param null $uri
     * @return bool
     */
    public function isBackendUri($uri = null)
    {
        $uri = $this->getSanitizedUri($uri);
        $backendPath = $this->getBackendPath();
        $uri = parse_url($uri, PHP_URL_PATH);

        return (strpos($uri, "/$backendPath/") === 0) || preg_match("|/$backendPath$|", $uri);
    }
}
