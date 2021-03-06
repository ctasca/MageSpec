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
namespace MageTest\PhpSpec\MagentoExtension\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * DescribeBlockCommand
 *
 * @category   MageTest
 * @package    PhpSpec_MagentoExtension
 *
 * @author     MageTest team (https://github.com/MageTest/MageSpec/contributors)
 */
class DescribeBlockCommand extends Command
{
    const VALIDATOR = '/^([a-zA-Z0-9]+)_([a-zA-Z0-9]+)\/([a-z0-9]+)(_[\w]+)?$/';

    protected function configure()
    {
        $this
            ->setName('describe:block')
            ->setDescription('Describe a Magento Block specification')
            ->addArgument('block_alias', InputArgument::REQUIRED, 'Magento Block alias to be described');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $block = $input->getArgument('block_alias');

        if ((bool) preg_match(self::VALIDATOR, $block) === false) {
            $message = <<<ERR
The block alias provided doesn't follow the Magento naming conventions.
Please make sure it looks like the following:

  vendorname_modulename/blockname

The lowercase convention is used because it reflects the best practice
convention within the Magento community. This reflects the identifier that
you would pass to Mage::getBlockSinglton() or in layout.xml
ERR;
            throw new \InvalidArgumentException($message);
        }

        $container = $this->getApplication()->getContainer();
        $container->configure();

        $classname = 'block:' . $block;
        $resource  = $container->get('locator.resource_manager')->createResource($classname);

        $container->get('code_generator')->generate($resource, 'specification');
    }
}
