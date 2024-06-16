<?php
namespace Coyote\Providers;

use Coyote\Services\Media\ImageWizard;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends \Coyote\Providers\Neon\ServiceProvider
{
    public function register(): void
    {
        $this->app->instance(ImageWizard::class, new ImageWizard());
    }
}
