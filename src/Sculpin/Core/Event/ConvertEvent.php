<?php

declare(strict_types=1);

/*
 * This file is a part of Sculpin.
 *
 * (c) Dragonfly Development Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sculpin\Core\Event;

use Sculpin\Core\Source\SourceInterface;

/**
 * Convert Source Event.
 *
 * @author Beau Simensen <beau@dflydev.com>
 */
class ConvertEvent extends Event
{
    /**
     * Source
     *
     * @var SourceInterface
     */
    protected $source;

    /**
     * Converter
     *
     * @var string
     */
    protected $converter;

    /**
     * Default formatter
     *
     * @var string
     */
    protected $defaultFormatter;

    /**
     * Constructor.
     *
     * @param SourceInterface $source           Source
     * @param string          $converter        Converter
     * @param string          $defaultFormatter Default formatter
     */
    public function __construct(SourceInterface $source, string $converter, string $defaultFormatter)
    {
        $this->source = $source;
        $this->converter = $converter;
        $this->defaultFormatter = $defaultFormatter;
    }

    /**
     * Source
     *
     * @return SourceInterface
     */
    public function source(): SourceInterface
    {
        return $this->source;
    }

    /**
     * Converter
     *
     * @return string
     */
    public function converter(): string
    {
        return $this->converter;
    }

    /**
     * Test if Source is converted by requested converter
     *
     * @param string $requestedConverter
     *
     * @return boolean
     */
    public function isConvertedBy(string $requestedConverter): bool
    {
        return $requestedConverter === $this->converter;
    }

    /**
     * Test if Source is formatted by requested formatter
     *
     * @param string $requestedFormatter
     *
     * @return boolean
     */
    public function isFormattedBy(string $requestedFormatter): bool
    {
        return $requestedFormatter == ($this->source->data()->get('formatter') ?: $this->defaultFormatter);
    }

    /**
     * Test if Source is converted and formatted by requested converter and formatter
     *
     * @param string $requestedConverter Converter
     * @param string $requestedFormatter Formatter
     *
     * @return boolean
     */
    public function isHandledBy(string $requestedConverter, string $requestedFormatter): bool
    {
        return $this->isConvertedBy($requestedConverter) and $this->isFormattedBy($requestedFormatter);
    }
}
