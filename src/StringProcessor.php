<?php

/**
 * This file is part of the Nginx Config Processor package.
 *
 * (c) Roman Piták <roman@pitak.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace RomanPitak\Nginx\Config;

abstract class StringProcessor
{

    /**
     * @var \RomanPitak\Nginx\Config\String $configString
     */
    private $configString;

    /**
     * @param \RomanPitak\Nginx\Config\String $configString
     */
    public function __construct(String $configString)
    {
        $this->configString = $configString;
        $this->run();
    }

    abstract protected function run();

    // common processing functions

    protected function skipComment()
    {
        if ('#' !== $this->configString->getChar()) {
            return false;
        }

        new Comment($this->configString);
        return true;
    }

    /**
     * @return \RomanPitak\Nginx\Config\String
     */
    protected function getConfigString()
    {
        return $this->configString;
    }

    // magic

    abstract public function prettyPrint($indentLevel, $spacesPerIndent = 4);

    public function __toString()
    {
        return $this->prettyPrint(-1);
    }

}
