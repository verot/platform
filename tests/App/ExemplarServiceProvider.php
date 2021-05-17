<?php

declare(strict_types=1);

namespace Orchid\Tests\App;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;
use Orchid\Tests\App\Screens\ConfirmScreen;
use Orchid\Tests\App\Screens\DependentListenerModalScreen;
use Orchid\Tests\App\Screens\DependentListenerScreen;
use Orchid\Tests\App\Screens\MethodsResponseScreen;
use Orchid\Tests\App\Screens\ModalValidationScreen;
use Orchid\Tests\App\Screens\NestedTargetsDependentSumListenerScreen;

class ExemplarServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     */
    public function boot(Dashboard $dashboard, Router $router): void
    {
        $dashboard->registerSearch([
            SearchUser::class,
        ]);

        $this->loadViewsFrom($dashboard->path('tests/App/Views'), 'exemplar');

        $router->domain((string) config('platform.domain'))
            ->prefix(Dashboard::prefix('/'))
            ->middleware(config('platform.middleware.private'))
            ->as('test.')
            ->group(function ($route) {
                $route->screen('modal-validation', ModalValidationScreen::class)->name('modal-validation');
                $route->screen('dependent-listener-nested-targets', NestedTargetsDependentSumListenerScreen::class)->name('dependent-listener-nested-targets');
                $route->screen('dependent-listener', DependentListenerScreen::class)->name('dependent-listener');
                $route->screen('dependent-listener-modal', DependentListenerModalScreen::class)->name('dependent-listener-modal');
                $route->screen('methods-response', MethodsResponseScreen::class)->name('methods-response');
                $route->screen('confirm', ConfirmScreen::class)->name('confirm');
            });
    }
}
