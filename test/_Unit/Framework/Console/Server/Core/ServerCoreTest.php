<?php

namespace Kraken\_Unit\Framework\Console\Server\Core;

use Kraken\Core\Core;
use Kraken\Framework\Console\Server\Core\ServerCore;
use Kraken\Runtime\Runtime;
use Kraken\Test\TUnit;

class ServerCoreTest extends TUnit
{
    /**
     *
     */
    public function testCaseRuntimeUnit_IsProcess()
    {
        $core = $this->createCore();

        $this->assertSame(Runtime::UNIT_PROCESS, $core::RUNTIME_UNIT);
    }

    /**
     *
     */
    public function testApiDefaultProviders_ReturnsDefaultProviders()
    {
        $core = $this->createCore();
        $providers = $this->callProtectedMethod($core, 'getDefaultProviders');

        $this->assertSame($this->getDefaultProviders(), $providers);

        foreach ($providers as $provider)
        {
            $this->assertTrue(class_exists($provider));
        }
    }

    /**
     *
     */
    public function testApiDefaultAliases_ReturnsDefaultAliases()
    {
        $core = $this->createCore();
        $aliases = $this->callProtectedMethod($core, 'getDefaultAliases');

        $this->assertSame($this->getDefaultAliases(), $aliases);

        foreach ($aliases as $alias=>$target)
        {
            $this->assertTrue(interface_exists($target) || class_exists($target), "Provider $target does not exist.");
        }
    }

    /**
     * @return string[]
     */
    public function getDefaultProviders()
    {
        return [
            'Kraken\Framework\Provider\ChannelProvider',
            'Kraken\Framework\Provider\CommandProvider',
            'Kraken\Framework\Provider\ConfigProvider',
            'Kraken\Framework\Provider\ContainerProvider',
            'Kraken\Framework\Provider\CoreProvider',
            'Kraken\Framework\Provider\EnvironmentProvider',
            'Kraken\Framework\Provider\SupervisorProvider',
            'Kraken\Framework\Provider\EventProvider',
            'Kraken\Framework\Provider\FilesystemProvider',
            'Kraken\Framework\Provider\LogProvider',
            'Kraken\Framework\Provider\LoopProvider',
            'Kraken\Framework\Provider\SystemProvider',
            'Kraken\Framework\Runtime\Provider\SupervisorProvider',
            'Kraken\Framework\Runtime\Provider\RuntimeProvider',
            'Kraken\Framework\Runtime\Provider\RuntimeBootProvider',
            'Kraken\Framework\Runtime\Provider\RuntimeManagerProvider',
            'Kraken\Framework\Console\Server\Provider\ChannelProvider',
            'Kraken\Framework\Console\Server\Provider\CommandProvider',
            'Kraken\Framework\Console\Server\Provider\ProjectProvider'
        ];
    }

    /**
     * @return string[]
     */
    public function getDefaultAliases()
    {
        return [
            'Channel'           => 'Kraken\Runtime\Service\ChannelInternal',
            'Channel.Internal'  => 'Kraken\Runtime\Service\ChannelInternal',
            'Command.Manager'   => 'Kraken\Runtime\Command\CommandManagerInterface',
            'Config'            => 'Kraken\Config\ConfigInterface',
            'Container'         => 'Kraken\Container\ContainerInterface',
            'Core'              => 'Kraken\Core\CoreInterface',
            'Emitter'           => 'Kraken\Event\EventEmitterInterface',
            'Environment'       => 'Kraken\Environment\EnvironmentInterface',
            'Filesystem'        => 'Kraken\Filesystem\FilesystemInterface',
            'Filesystem.Disk'   => 'Kraken\Filesystem\FilesystemInterface',
            'Filesystem.Cloud'  => 'Kraken\Filesystem\FilesystemManagerInterface',
            'Logger'            => 'Kraken\Log\LoggerInterface',
            'Loop'              => 'Kraken\Loop\LoopInterface',
            'Project.Manager'   => 'Kraken\Console\Server\Manager\ProjectManagerInterface',
            'Runtime'           => 'Kraken\Runtime\RuntimeContainerInterface',
            'Runtime.Context'   => 'Kraken\Runtime\RuntimeContextInterface',
            'Supervisor'        => 'Kraken\Runtime\Supervisor\SupervisorBaseInterface',
            'Supervisor.Base'   => 'Kraken\Runtime\Supervisor\SupervisorBaseInterface',
            'Supervisor.Remote' => 'Kraken\Runtime\Supervisor\SupervisorRemoteInterface',
            'System'            => 'Kraken\Util\System\SystemInterface'
        ];
    }

    /**
     * @return Core
     */
    public function createCore()
    {
        return new ServerCore();
    }
}
