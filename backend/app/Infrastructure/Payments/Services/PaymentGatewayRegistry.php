<?php

namespace App\Infrastructure\Payments\Services;

use App\Infrastructure\Payments\Contracts\PaymentGatewayInterface;
use InvalidArgumentException;

final class PaymentGatewayRegistry
{
    /** @var array<string, PaymentGatewayInterface> */
    private array $gateways = [];

    public function __construct(iterable $gateways)
    {
        foreach ($gateways as $gateway) {
            $this->gateways[$gateway->code()] = $gateway;
        }
    }

    public function get(string $code): PaymentGatewayInterface
    {
        return $this->gateways[$code]
            ?? throw new InvalidArgumentException("Aucune gateway enregistrée pour [$code].");
    }

    public function all(): array
    {
        return array_values($this->gateways);
    }
}




