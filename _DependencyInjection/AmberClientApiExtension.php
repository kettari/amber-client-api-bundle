<?php

namespace Amber\ClientApiBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class AmberClientApiExtension extends Extension {

  /**
   * @param array $configs
   * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
   */
  public function load(array $configs, ContainerBuilder $container) {
    $configuration = new Configuration();
    $config = $this->processConfiguration($configuration, $configs);
    // Set parameters
    $container->setParameter('amber_client_api', $config);

    $loader = new YamlFileLoader($container,
      new FileLocator(__DIR__.'/../Resources/config'));
    $loader->load('services.yml');
  }
}