<?php

namespace App\Providers;

use App\Repositories\Contracts\CardRepositoryInterface;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Eloquent\CardRepositoryEloquent;
use App\Repositories\Eloquent\CompanyRepositoryEloquent;
use App\Repositories\Eloquent\InvoiceRepositoryEloquent;
use App\Repositories\Eloquent\TransactionRepositoryEloquent;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Generator::class, function () {
            return Factory::create('pt_BR');
        });

        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepositoryEloquent::class);
        $this->app->bind(CardRepositoryInterface::class, CardRepositoryEloquent::class);
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepositoryEloquent::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepositoryEloquent::class);
    }
}
