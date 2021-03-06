<?php

namespace Symfony\Component\DependencyInjection\Configuration;

use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * This class is the entry point for config normalization/merging/finalization.
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class Processor
{
    /**
     * Processes a node tree.
     *
     * @param NodeInterface $configTree The node tree to process
     * @param array $configs An array of configuration items
     * @return boolean
     */
    public function process(NodeInterface $configTree, array $configs)
    {
        $configs = Extension::normalizeKeys($configs);

        $currentConfig = array();
        foreach ($configs as $config) {
            $config = $configTree->normalize($config);
            $currentConfig = $configTree->merge($currentConfig, $config);
        }

        return $configTree->finalize($currentConfig);
    }
}