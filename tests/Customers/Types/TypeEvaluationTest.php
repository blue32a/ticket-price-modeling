<?php

declare(strict_types=1);

namespace Tests\Customers\Types;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Customers\CustomerFactory;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\TypeEvaluation as SUT;
use TicketPriceModeling\Customers\Types\Type;

class TypeEvaluationTest extends TestCase
{
    #[DataProvider('matchTypeDataProvider')]
    #[Test]
    public function 顧客にマッチするタイプが含まれる(Customer $customer, Type $expected): void
    {
        $this->assertContains($expected, SUT::evaluate($customer));
    }

    public static function matchTypeDataProvider(): array
    {
        return [
            'シネマシティズンシニア会員' => [CustomerFactory::６０歳でシネマシティズン会員(), Type::CinemaCitizenSenior],
            'シネマシティズン会員' => [CustomerFactory::シネマシティズン会員(), Type::CinemaCitizen],
            '一般' => [CustomerFactory::３０歳で証明書無し(), Type::General],
            'シニア' => [CustomerFactory::７０歳で身分証明書を保持している(), Type::Senior],
            '大学生'  => [CustomerFactory::１９歳で大学の学生証を保持している(), Type::UniversityStudent],
            '専門学生' => [CustomerFactory::１９歳で専門学校の学生証を保持している(), Type::ProfessionalStudent],
            '高校生' => [CustomerFactory::１６歳で高校の学生証を保持している(), Type::HighSchoolStudent],
            '中学生' => [CustomerFactory::１４歳で中学の学生証を保持している(), Type::MiddleSchoolStudent],
            '小人' => [CustomerFactory::３歳で証明書無し(), Type::Child],
            '障がい者' => [CustomerFactory::障害者手帳を保持している(), Type::Disability],
        ];
    }

    #[Test]
    public function 顧客にマッチするタイプが全て含まれる(): void
    {
        // Arrange
        $customer = CustomerFactory::６０歳でシネマシティズン会員();

        // Act
        $types = SUT::evaluate($customer);

        // Assert
        $this->assertCount(3, $types);
        $this->assertContains(Type::CinemaCitizenSenior, $types);
        $this->assertContains(Type::CinemaCitizen, $types);
        $this->assertContains(Type::General, $types);
    }
}
