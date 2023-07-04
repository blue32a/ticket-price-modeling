<?php

declare(strict_types=1);

namespace Tests\Customers;

use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Certificate;
use TicketPriceModeling\Customers\Customer;

class CustomerFactory
{
    public static function ３歳で証明書無し(): Customer
    {
        return new Customer(new Age(3));
    }

    public static function １２歳で証明書無し(): Customer
    {
        return new Customer(new Age(12));
    }

    public static function １３歳で証明書無し(): Customer
    {
        return new Customer(new Age(13));
    }

    public static function シネマシティズン会員(): Customer
    {
        return new Customer(new Age(30), [Certificate::CinemaCitizen]);
    }

    public static function ５９歳でシネマシティズン会員(): Customer
    {
        return new Customer(new Age(59), [Certificate::CinemaCitizen]);
    }

    public static function ６０歳で証明書無し(): Customer
    {
        return new Customer(new Age(60));
    }

    public static function ６０歳でシネマシティズン会員(): Customer
    {
        return new Customer(new Age(60), [Certificate::CinemaCitizen]);
    }

    public static function 障害者手帳を保持している(): Customer
    {
        return new Customer(new Age(30), [Certificate::Disability]);
    }

    public static function ３０歳で証明書無し(): Customer
    {
        return new Customer(new Age(30));
    }

    public static function １６歳で高校の学生証を保持している(): Customer
    {
        return new Customer(new Age(16), [Certificate::HighSchoolStudent]);
    }

    public static function １４歳で中学の学生証を保持している(): Customer
    {
        return new Customer(new Age(14), [Certificate::MiddleSchoolStudent]);
    }

    public static function １９歳で専門学校の学生証を保持している(): Customer
    {
        return new Customer(new Age(19), [Certificate::ProfessionalStudent]);
    }

    public static function １９歳で大学の学生証を保持している(): Customer
    {
        return new Customer(new Age(19), [Certificate::UniversityStudent]);
    }

    public static function ７０歳で身分証明書を保持している(): Customer
    {
        return new Customer(new Age(70), [Certificate::Identification]);
    }
}
