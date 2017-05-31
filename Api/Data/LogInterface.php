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

namespace MSP\SecuritySuiteCommon\Api\Data;

interface LogInterface
{
    const ID = 'msp_securitysuite_log_id';
    const DATETIME = 'datetime';
    const IP = 'ip';
    const MODULE = 'module';
    const USER = 'user';
    const MESSAGE = 'message';
    const URL = 'url';
    const COUNT = 'count';
    const ACTION = 'action';
    const ADDITIONAL = 'additional';

    const REPETITION_TIMEOUT_INTERVAL = 60;

    /**
     * Get value for msp_securitysuite_log_id
     * @return int
     */
    public function getId();

    /**
     * Get value for datetime
     * @return string
     */
    public function getDatetime();

    /**
     * Get value for ip
     * @return string
     */
    public function getIp();

    /**
     * Get value for module
     * @return string
     */
    public function getModule();

    /**
     * Get value for user
     * @return string
     */
    public function getUser();

    /**
     * Get value for message
     * @return string
     */
    public function getMessage();

    /**
     * Get value for url
     * @return string
     */
    public function getUrl();

    /**
     * Get value for count
     * @return int
     */
    public function getCount();

    /**
     * Get value for action
     * @return string
     */
    public function getAction();

    /**
     * Get value for additional
     * @return string
     */
    public function getAdditional();

    /**
     * Set value for msp_securitysuite_log_id
     * @param int $value
     * @return $this
     */
    public function setId($value);

    /**
     * Set value for datetime
     * @param string $value
     * @return $this
     */
    public function setDatetime($value);

    /**
     * Set value for ip
     * @param string $value
     * @return $this
     */
    public function setIp($value);

    /**
     * Set value for module
     * @param string $value
     * @return $this
     */
    public function setModule($value);

    /**
     * Set value for user
     * @param string $value
     * @return $this
     */
    public function setUser($value);

    /**
     * Set value for message
     * @param string $value
     * @return $this
     */
    public function setMessage($value);

    /**
     * Set value for url
     * @param string $value
     * @return $this
     */
    public function setUrl($value);

    /**
     * Set value for count
     * @param int $value
     * @return $this
     */
    public function setCount($value);

    /**
     * Set value for action
     * @param string $value
     * @return $this
     */
    public function setAction($value);

    /**
     * Set value for additional
     * @param string $value
     * @return $this
     */
    public function setAdditional($value);
}
