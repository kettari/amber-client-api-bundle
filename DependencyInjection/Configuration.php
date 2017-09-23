<?php

namespace Amber\ClientApiBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {

  /**
   * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder
   */
  public function getConfigTreeBuilder() {
    $treeBuilder = new TreeBuilder();
    $rootNode = $treeBuilder->root('amber_client_api');

    // @formatter:off
    /** @noinspection PhpUndefinedMethodInspection */
    $rootNode
      ->children()
          ->scalarNode('url')->end()
          ->scalarNode('serviceKey')->end()
        ->end()
      ->end();
    // @formatter:on

    return $treeBuilder;
  }

}