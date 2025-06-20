<?php

declare(strict_types=1);

/*
 * This file is part of rekalogika/analytics package.
 *
 * (c) Priyadi Iman Nurcahyo <https://rekalogika.dev>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Rekalogika\Analytics\Bundle\UI\SpecificFilterFactory;

use Rekalogika\Analytics\Bundle\UI\Filter;
use Rekalogika\Analytics\Bundle\UI\Filter\NullFilter;
use Rekalogika\Analytics\Bundle\UI\SpecificFilterFactory;
use Rekalogika\Analytics\Metadata\Summary\SummaryMetadataFactory;

/**
 * @implements SpecificFilterFactory<NullFilter>
 */
final readonly class NullFilterFactory implements SpecificFilterFactory
{
    public function __construct(
        private SummaryMetadataFactory $summaryMetadataFactory,
    ) {}

    #[\Override]
    public static function getFilterClass(): string
    {
        return NullFilter::class;
    }

    #[\Override]
    public function createFilter(
        string $summaryClass,
        string $dimension,
        array $inputArray,
        ?object $options = null,
    ): Filter {
        $metadata = $this->summaryMetadataFactory
            ->getSummaryMetadata($summaryClass);

        $dimensionMetadata = $metadata->getAnyDimension($dimension);
        $label = $dimensionMetadata->getLabel();

        return new NullFilter(
            dimension: $dimension,
            label: $label,
        );
    }
}
