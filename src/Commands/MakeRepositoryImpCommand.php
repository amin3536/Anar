<?php
namespace amin3520\Anar\Commands;


use Illuminate\Console\GeneratorCommand;

class MakeRepositoryImpCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repositoryImp {name}';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:repositoryImp';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repositoryImp interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'RepositoryImp';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/repositoryImp.stub';
    }



    protected function getDefaultNamespace($rootNamespace) {

        return $rootNamespace.'\Repositories';
    }



}
