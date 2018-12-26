<?php
/**
 * Created by PhpStorm.
 * User: a.mir
 * Date: 25/12/2018
 * Time: 01:00 PM
 */

namespace amin3520\Anar\Commands;


use Illuminate\Console\GeneratorCommand;

class MakeRepositoryProvider extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repositoryServiceProvider {name}';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:repositoryProvider';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create repositoryProvider Service';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'repositoryServiceProvider';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/repositoryProvider.stub';
    }



    protected function getDefaultNamespace($rootNamespace) {

        return $rootNamespace.'\Providers';
    }



}
