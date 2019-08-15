<?php

namespace App\Console\Commands;


use Illuminate\Console\GeneratorCommand;
class AddInterface extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:interface';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Interface  class using the artisan command';
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Interface';
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/interface.stub';
    }
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Interfaces';
    }
}
