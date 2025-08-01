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

namespace Rekalogika\Analytics\Bundle\EventListener;

use Psr\Log\LoggerInterface;
use Rekalogika\Analytics\Engine\SummaryRefresher\Event\AbstractEndEvent;
use Rekalogika\Analytics\Engine\SummaryRefresher\Event\AbstractStartEvent;
use Rekalogika\Analytics\Engine\SummaryRefresher\Event\DeleteRangeEndEvent;
use Rekalogika\Analytics\Engine\SummaryRefresher\Event\DeleteRangeStartEvent;
use Rekalogika\Analytics\Engine\SummaryRefresher\Event\RefreshEndEvent;
use Rekalogika\Analytics\Engine\SummaryRefresher\Event\RefreshRangeEndEvent;
use Rekalogika\Analytics\Engine\SummaryRefresher\Event\RefreshRangeStartEvent;
use Rekalogika\Analytics\Engine\SummaryRefresher\Event\RefreshStartEvent;
use Rekalogika\Analytics\Engine\SummaryRefresher\Event\RollUpRangeEndEvent;
use Rekalogika\Analytics\Engine\SummaryRefresher\Event\RollUpRangeStartEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final readonly class RefreshLoggerEventSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private ?LoggerInterface $logger = null,
    ) {}

    #[\Override]
    public static function getSubscribedEvents()
    {
        return [
            RefreshStartEvent::class => 'onRefreshStartEvent',
            RefreshEndEvent::class => 'onRefreshEndEvent',
            RefreshRangeStartEvent::class => 'onStartEvent',
            RefreshRangeEndEvent::class => 'onEndEvent',
            DeleteRangeStartEvent::class => 'onStartEvent',
            DeleteRangeEndEvent::class => 'onEndEvent',
            RollUpRangeStartEvent::class => 'onStartEvent',
            RollUpRangeEndEvent::class => 'onEndEvent',
        ];
    }

    public function onRefreshStartEvent(RefreshStartEvent $event): void
    {
        $this->logger?->debug('Refresh start', [
            'class' => $event->getClass(),
            'startValue' => Printer::print($event->getInputStartValue()),
            'endValue' => Printer::print($event->getInputEndValue()),
            'start' => Printer::print($event->getStart()),
        ]);
    }

    public function onRefreshEndEvent(RefreshEndEvent $event): void
    {
        $this->logger?->debug('Refresh end', [
            'class' => $event->getClass(),
            'startValue' => Printer::print($event->getInputStartValue()),
            'endValue' => Printer::print($event->getInputEndValue()),
            'start' => Printer::print($event->getStart()),
            'end' => Printer::print($event->getEnd()),
            'duration' => Printer::print($event->getDuration()),
        ]);
    }

    public function onStartEvent(AbstractStartEvent $event): void
    {
        $this->logger?->debug((string) $event, [
            'class' => $event->getClass(),
            'start' => Printer::print($event->getStart()),
            'range' => Printer::print($event->getRange()),
        ]);
    }

    public function onEndEvent(AbstractEndEvent $event): void
    {
        $this->logger?->debug((string) $event, [
            'class' => $event->getClass(),
            'start' => Printer::print($event->getStart()),
            'range' => Printer::print($event->getRange()),
            'duration' => Printer::print($event->getDuration()),
        ]);
    }
}
