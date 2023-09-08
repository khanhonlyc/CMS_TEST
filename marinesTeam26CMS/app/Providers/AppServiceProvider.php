<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $this->app['request']->server->set('HTTPS','on');
        Storage::extend('sftp1', function ($app, $config) {
            return new Filesystem(new SftpAdapter($config));
        });
        Storage::extend('sftp2', function ($app, $config) {
            return new Filesystem(new SftpAdapter($config));
        });
    }
}
