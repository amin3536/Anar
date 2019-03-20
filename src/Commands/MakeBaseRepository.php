<?php
namespace amin3520\Anar\Commands;


use Illuminate\Console\GeneratorCommand;

class MakeBaseRepository extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:baseRepository {name}';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:baseRepository';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a BaseRepository class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'BaseRepository';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/BaseRepository.stub';
    }



    protected function getDefaultNamespace($rootNamespace) {

        return $rootNamespace.'\Repositories';
    }



}
