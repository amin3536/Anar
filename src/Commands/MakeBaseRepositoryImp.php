<?php
/**
 * Created by PhpStorm.
 * User: a.mir
 * Date: 23/12/2018
 * Time: 09:37 AM
 */

namespace amin3520\Anar\Commands;


use Illuminate\Console\GeneratorCommand;

class MakeBaseRepositoryImp extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:baseRepositoryImp {name}';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:baseRepositoryImp';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a BaseRepositoryImp interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'BaseRepositoryImp';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/BaseRepositoryImp.stub';
    }



    protected function getDefaultNamespace($rootNamespace) {

        return $rootNamespace.'\Repositories';
    }



}
