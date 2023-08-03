<?php

declare(strict_types=1);

namespace Tests\Customer\Type;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\Customer\CustomerPersonFactory;
use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Customer\Type\TypeEvaluation;
use TicketPriceModeling\Customer\Type\Type;

class TypeEvaluationTest extends TestCase
{
    #[DataProvider('matchTypeDataProvider')]
    #[Test]
    public function 顧客にマッチするタイプが含まれる(Person $person, Type $expected): void
    {
        // Arrange
        $sut = new TypeEvaluation();

        // Act & Assert
        $this->assertContains($expected, $sut->evaluate($person));
    }

    public static function matchTypeDataProvider(): array
    {
        return [
            'シネマシティズンシニア会員' => [CustomerPersonFactory::６０歳でシネマシティズン会員(), Type::CinemaCitizenSenior],
            'シネマシティズン会員' => [CustomerPersonFactory::シネマシティズン会員(), Type::CinemaCitizen],
            '一般' => [CustomerPersonFactory::３０歳で証明書無し(), Type::General],
            'シニア' => [CustomerPersonFactory::７０歳で身分証明書を保持している(), Type::Senior],
            '大学生'  => [CustomerPersonFactory::１９歳で大学の学生証を保持している(), Type::UniversityStudent],
            '専門学生' => [CustomerPersonFactory::１９歳で専門学校の学生証を保持している(), Type::ProfessionalStudent],
            '高校生' => [CustomerPersonFactory::１６歳で高校の学生証を保持している(), Type::HighSchoolStudent],
            '中学生' => [CustomerPersonFactory::１４歳で中学の学生証を保持している(), Type::MiddleSchoolStudent],
            '小人' => [CustomerPersonFactory::３歳で証明書無し(), Type::Child],
            '障がい者' => [CustomerPersonFactory::障害者手帳を保持している(), Type::Disability],
        ];
    }

    #[Test]
    public function 顧客にマッチするタイプが全て含まれる(): void
    {
        // Arrange
        $sut = new TypeEvaluation();
        $customer = CustomerPersonFactory::６０歳でシネマシティズン会員();

        // Act
        $types = $sut->evaluate($customer);

        // Assert
        $this->assertCount(3, $types);
        $this->assertContains(Type::CinemaCitizenSenior, $types);
        $this->assertContains(Type::CinemaCitizen, $types);
        $this->assertContains(Type::General, $types);
    }
}
