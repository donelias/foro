<?php

use App\User;
use Illuminate\Foundation\Application;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * @var \App\User
     */

    protected $defaultUser;

    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function defaultUser()
    {
        //consultar si el usuario fue creado por defecto
        if ($this->defaultUser)
        {
            return $this->defaultUser;
        }


        //crear un usuario
        return $this->defaultUser = factory(User::class)->create();
    }
}
