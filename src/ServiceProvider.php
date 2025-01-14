<?php

namespace Badak\Indonesia;

use Badak\Indonesia\Commands\SeedCommand;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Support\Str;

// use Badak\Indonesia\Commands\SyncCoordinateCommand;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->bind('indonesia', function () {
            return new IndonesiaService;
        });

        $this->commands([
            SeedCommand::class,
            // SyncCoordinateCommand::class,
        ]);
    }

    /*
        for lumen version <=5.2, just copy the migrations from the package directory
    */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/indonesia.php', 'wilayah-indonesia');

        $databasePath = __DIR__.'/../database/migrations';
        if ($this->isLumen()) {
            $this->loadMigrationsFrom($databasePath);
        } else {
            $this->publishes([$databasePath => database_path('migrations')], 'migrations');
        }

        if (class_exists(Application::class)) {
            $this->publishes(
                [
                    __DIR__.'/../config/indonesia.php' => config_path('wilayah-indonesia.php'),
                ],
                'config'
            );
        }

        if ($this->app->bound('badak.acl')) {
            $this->app['badak.acl']->registerPermission(Permission::toArray());
        }

        $this->registerMacro();
    }

    protected function registerMacro()
    {
        EloquentBuilder::macro('whereLike', function ($attributes, string $searchTerm) {
            $this->where(function (EloquentBuilder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        Str::contains($attribute, '.'),
                        function (EloquentBuilder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas(
                                $relationName,
                                function (EloquentBuilder $query) use ($relationAttribute, $searchTerm) {
                                    $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                                }
                            );
                        },
                        function (EloquentBuilder $query) use ($attribute, $searchTerm) {
                            $table = $query->getModel()->getTable();
                            $query->orWhere(sprintf('%s.%s', $table, $attribute), 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });
    }

    protected function isLaravel()
    {
        return app() instanceof \Illuminate\Foundation\Application;
    }

    protected function isLumen()
    {
        return ! $this->isLaravel();
    }
}
