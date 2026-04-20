<?php

namespace App\Providers;

use App\Infrastructure\Notifications\Channels\InAppNotificationChannel;
use App\Infrastructure\Notifications\Channels\MailNotificationChannel;
use App\Infrastructure\Notifications\Services\NotificationChannelRegistry;
use App\Infrastructure\Payments\Providers\BankCard\BankCardPaymentGateway;
use App\Infrastructure\Payments\Providers\Cash\CashPaymentGateway;
use App\Infrastructure\Payments\Providers\MobileMoney\MobileMoneyPaymentGateway;
use App\Infrastructure\Payments\Services\PaymentGatewayRegistry;
use App\Infrastructure\Storage\Services\LocalMediaStorage;
use App\Infrastructure\Storage\Services\MediaStorageRegistry;
use Illuminate\Support\ServiceProvider;

final class InfrastructureServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BankCardPaymentGateway::class);
        $this->app->singleton(CashPaymentGateway::class);
        $this->app->singleton(MobileMoneyPaymentGateway::class);

        $this->app->tag([
            BankCardPaymentGateway::class,
            CashPaymentGateway::class,
            MobileMoneyPaymentGateway::class,
        ], 'payment.gateways');

        $this->app->singleton(PaymentGatewayRegistry::class, function ($app) {
            return new PaymentGatewayRegistry($app->tagged('payment.gateways'));
        });

        $this->app->singleton(InAppNotificationChannel::class);
        $this->app->singleton(MailNotificationChannel::class);

        $this->app->tag([
            InAppNotificationChannel::class,
            MailNotificationChannel::class,
        ], 'notification.channels');

        $this->app->singleton(NotificationChannelRegistry::class, function ($app) {
            return new NotificationChannelRegistry($app->tagged('notification.channels'));
        });

        $this->app->singleton(LocalMediaStorage::class, fn () => new LocalMediaStorage('public'));

        $this->app->tag([
            LocalMediaStorage::class,
        ], 'media.storage');

        $this->app->singleton(MediaStorageRegistry::class, function ($app) {
            return new MediaStorageRegistry($app->tagged('media.storage'));
        });
    }
}
