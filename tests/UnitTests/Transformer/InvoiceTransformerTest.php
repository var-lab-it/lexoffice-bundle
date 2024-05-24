<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Transformer;

use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use VarLabIT\LexofficeBundle\Transformer\InvoiceTransformer;
use function Safe\file_get_contents;

class InvoiceTransformerTest extends TestCase
{
    use MatchesSnapshots;

    public function testTransformToObject(): void
    {
        $data = file_get_contents(__DIR__ . '/mocks/invoice_1.json');

        $result = InvoiceTransformer::getInstance()->transformToObject($data);

        $transformedData = InvoiceTransformer::getInstance()->transformFromObject($result);

        self::assertMatchesJsonSnapshot($transformedData);
    }
}
