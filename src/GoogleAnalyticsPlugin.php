<?php

declare(strict_types=1);

namespace BezhanSalleh\GoogleAnalytics;

use Closure;
use BezhanSalleh\GoogleAnalytics\Pages\GoogleAnalyticsDashboard;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;

class GoogleAnalyticsPlugin implements Plugin
{
    use EvaluatesClosures;

    protected bool | Closure $authorizeUsing = true;

    public static function make(): static
    {
        return app(static::class);
    }

    public function authorize(bool | Closure $callback = true): static
    {
        $this->authorizeUsing = $callback;

        return $this;
    }

    public function isAuthorized(): bool
    {
        return $this->evaluate($this->authorizeUsing) === true;
    }

    public function getId(): string
    {
        return 'filament-google-analytics';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->pages([
                GoogleAnalyticsDashboard::class,
            ])
            ->widgets([
                Widgets\PageViewsWidget::class,
                Widgets\VisitorsWidget::class,
                Widgets\ActiveUsersOneDayWidget::class,
                Widgets\ActiveUsersSevenDayWidget::class,
                Widgets\ActiveUsersTwentyEightDayWidget::class,
                Widgets\SessionsWidget::class,
                Widgets\SessionsByCountryWidget::class,
                Widgets\SessionsDurationWidget::class,
                Widgets\SessionsByDeviceWidget::class,
                Widgets\MostVisitedPagesWidget::class,
                Widgets\TopReferrersListWidget::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
