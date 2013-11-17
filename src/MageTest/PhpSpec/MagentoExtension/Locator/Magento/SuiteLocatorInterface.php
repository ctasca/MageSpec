<?php
/**
 * MageSpec
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License, that is bundled with this
 * package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 *
 * http://opensource.org/licenses/MIT
 *
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world-wide-web, please send an email
 * to <magetest@sessiondigital.com> so we can send you a copy immediately.
 *
 * @category   MageTest
 * @package    PhpSpec_MagentoExtension
 *
 * @copyright  Copyright (c) 2012-2013 MageTest team and contributors.
 */
namespace MageTest\PhpSpec\MagentoExtension\Locator\Magento;

interface SuiteLocatorInterface
{
    /**
     *
     * Default implementation
     *
     * $moduleFile = str_replace($this->getFullSpecPath(), '', $file);
     * $moduleFileParts = explode(DIRECTORY_SEPARATOR, $moduleFile);
     * if (count($moduleFileParts) > 3) {
     * $suitenameChunks = array_chunk($moduleFileParts, 3);
     * $possibleSuitePath = $this->getFullSrcPath() . implode(DIRECTORY_SEPARATOR, $suitenameChunks[0]);
     * return is_file($possibleSuitePath . DIRECTORY_SEPARATOR . 'etc/config.xml');
     *  }
     * return false;
     *
     * @param $file
     * @return bool
     */
    public function isSuiteLocator($file);
}
