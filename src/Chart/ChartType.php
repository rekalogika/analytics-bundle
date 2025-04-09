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

namespace Rekalogika\Analytics\Bundle\Chart;

enum ChartType
{
    case Auto;
    case Bar;
    case Line;
    case StackedBar;
    case GroupedBar;
    case Pie;
    case None;
}
