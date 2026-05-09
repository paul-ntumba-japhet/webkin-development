<?php


namespace Tests\Feature\Payments;

use Tests\TestCase;
use InvalidArgumentException;
use App\Infrastructure\Payments\Services\PaymentGatewayRegistry;
use App\Infrastructure\Payments\Providers\BankCard\BankCardPaymentGateway;
use App\Infrastructure\Payments\Providers\MobileMoney\MobileMoneyPaymentGateway;
use App\Infrastructure\Payments\Providers\Cash\CashPaymentGateway;

final class PaymentGatewayRegistryTest extends TestCase
{
    public function test_it_resolves_gateway_by_code(): void
    {
        $registry = $this->app->make(PaymentGatewayRegistry::class);

        $bankCard = $registry->get('bank_card');
        $mobileMoney = $registry->get('mobile_money');
        $cash = $registry->get('cash');

        $this->assertInstanceOf(BankCardPaymentGateway::class, $bankCard);
        $this->assertInstanceOf(MobileMoneyPaymentGateway::class, $mobileMoney);
        $this->assertInstanceOf(CashPaymentGateway::class, $cash);
    }

    public function test_it_returns_all_registered_gateways(): void
    {
        /*$registry = $this->app->make(PaymentGatewayRegistry::class);

        $gateways = $registry->all();

        $this->assertCount(3, $gateways);
        $this->assertContainsOnlyInstancesOf(
            \App\Infrastructure\Payments\Contracts\PaymentGatewayInterface::class,
            $gateways
        );*/
        $registry = $this->app->make(PaymentGatewayRegistry::class);

        $gateways = $registry->all();

        $this->assertCount(3, $gateways);

        $this->assertContainsOnlyInstancesOf(
            \App\Infrastructure\Payments\Contracts\PaymentGatewayInterface::class,
            $gateways
        );

        $codes = array_map(
            fn ($gateway) => $gateway->code(),
            $gateways
        );

        $this->assertEqualsCanonicalizing(
            ['bank_card', 'mobile_money', 'cash'],
            $codes
        );
    }

    public function test_it_throws_an_exception_for_unknown_gateway_code(): void
    {
        $registry = $this->app->make(PaymentGatewayRegistry::class);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Aucune gateway enregistrée pour [unknown].');

        $registry->get('unknown');
    }
}
