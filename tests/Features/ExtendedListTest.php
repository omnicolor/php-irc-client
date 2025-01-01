<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\ExtendedList;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[Small]
final class ExtendedListTest extends TestCase
{
    public function testEmpty(): void
    {
        $extended_list = new ExtendedList('');
        self::assertSame('', (string)$extended_list);
        self::assertFalse($extended_list->supportsSearchByChannelCreation());
        self::assertFalse($extended_list->supportsSearchByMask());
        self::assertFalse($extended_list->supportsSearchByNonMatchingMask());
        self::assertFalse($extended_list->supportsSearchByTopicSetTime());
        self::assertFalse($extended_list->supportsSearchByUserCount());
    }

    public function testFull(): void
    {
        $extended_list = new ExtendedList('CMNTUX');
        self::assertSame('CMNTUX', (string)$extended_list);
        self::assertTrue($extended_list->supportsSearchByChannelCreation());
        self::assertTrue($extended_list->supportsSearchByMask());
        self::assertTrue($extended_list->supportsSearchByNonMatchingMask());
        self::assertTrue($extended_list->supportsSearchByTopicSetTime());
        self::assertTrue($extended_list->supportsSearchByUserCount());
    }

    /** @return array<int, array<int, bool|string>> */
    public static function elistProvider(): array
    {
        return [
            ['C', true, false, false, false, false],
            ['M', false, true, false, false, false],
            ['N', false, false, true, false, false],
            ['T', false, false, false, true, false],
            ['U', false, false, false, false, true],
        ];
    }

    #[DataProvider('elistProvider')]
    public function testIndividualSupport(
        string $feature,
        bool $search_by_channel,
        bool $search_by_mask,
        bool $search_by_non_matching_mask,
        bool $search_by_topic_set_time,
        bool $search_by_user_count,
    ): void {
        $extended_list = new ExtendedList($feature);
        self::assertSame(
            $search_by_channel,
            $extended_list->supportsSearchByChannelCreation(),
        );
        self::assertSame(
            $search_by_mask,
            $extended_list->supportsSearchByMask(),
        );
        self::assertSame(
            $search_by_non_matching_mask,
            $extended_list->supportsSearchByNonMatchingMask(),
        );
        self::assertSame(
            $search_by_topic_set_time,
            $extended_list->supportsSearchByTopicSetTime(),
        );
        self::assertSame(
            $search_by_user_count,
            $extended_list->supportsSearchByUserCount(),
        );
    }
}
