<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            'App\Repositories\User\UserInterface',
            'App\Repositories\User\UserRepository'
        );
        $this->app->bind(
            'App\Repositories\Category\CategoryInterface',
            'App\Repositories\Category\CategoryRepository'
        );
        $this->app->bind(
            'App\Repositories\SubCategory\SubCategoryInterface',
            'App\Repositories\SubCategory\SubCategoryRepository'
        );
        $this->app->bind(
            'App\Repositories\Projects\ProjectInterface',
            'App\Repositories\Projects\ProjectRepository'
        );
        $this->app->bind(
            'App\Repositories\Reviews\ReviewsInterface',
            'App\Repositories\Reviews\ReviewsRepository'
        );
        $this->app->bind(
            'App\Repositories\ServiceProvider\ServiceProviderInterface',
            'App\Repositories\ServiceProvider\ServiceProviderRepository'
        );
        $this->app->bind(
            'App\Repositories\Consultant\ConsultantInterface',
            'App\Repositories\Consultant\ConsultantRepository'
        );
        $this->app->bind(
            'App\Repositories\Authentication\AuthenticationRepositoryInterface',
            'App\Repositories\Consultant\AuthenticationRepository'
        );
        $this->app->bind(
            'App\Repositories\Degree\DegreeInterface',
            'App\Repositories\Degree\DegreRepository'
        );
        $this->app->bind(
            'App\Repositories\Programme\ProgrammeInterface',
            'App\Repositories\Programme\ProgrammeRepository'
        );
        $this->app->bind(
             'App\Repositories\Admin\AdminRepositoryInterface',
             'App\Repositories\Admin\AdminRepository'
        );
        $this->app->bind(
            'App\Repositories\PaymentMethods\PaymentMethodsInterface',
            'App\Repositories\PaymentMethods\PaymentMethodsRepository'
        );
        $this->app->bind(
            'App\Repositories\Bid\BidRepositoryInterface',
            'App\Repositories\Bid\BidRepository'
        );
        $this->app->bind(
            'App\Repositories\Payments\PaymentsInterface',
            'App\Repositories\Payments\PaymentsRepository'
        );
        $this->app->bind(
            'App\Repositories\Wallet\WalletInterface',
            'App\Repositories\Wallet\WalletRepository'
        );
        $this->app->bind(
            'App\Repositories\Transactions\TransactionsInterface',
            'App\Repositories\Transactions\TransactionsRepository'
        );
    }
}
