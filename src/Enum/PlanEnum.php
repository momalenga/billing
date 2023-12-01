<?php
namespace Shengamo\Billing\Enum;

enum PlanEnum: string
{
    case MICROSME = 'microSME';
    case SME = 'SME';
    case MEDIUM = 'Medium';

    public function price(): int
    {
        return match($this){
            self::MICROSME=> 90,
            self::SME => 520,
            self::MEDIUM => 1000,
        };
    }

    public function duration(): int
    {
        return match($this){
            self::MICROSME=> 1,
            self::SME => 6,
            self::MEDIUM => 12,
        };
    }

    public function tagline(): string
    {
        return match($this){
            self::MICROSME=> 'One Month plan',
            self::SME => 'Six Month plan',
            self::MEDIUM => 'Annual plan',
        };
    }

    public function annualPrice(): int
    {
        return match($this){
            self::MEDIUM => 900,
            self::MICROSME=> 900,
            self::SME => 500,
        };
    }

    public function features(): array
    {
        return match($this){

            self::MICROSME=> [
                '1 User',
                '1 Bank Account',
                '50 Clients',
            ],

            self::SME => [
                '1 User',
                '1 Bank Account',
                '50 Clients',
                'Six month plan'
            ],

            self::MEDIUM => [
                '1 User',
                '1 Bank Account',
                '50 Clients',
                'Annual plan'
            ],
        };
    }

}
