<?php

namespace amin3520\Anar\Commands;

use Illuminate\Console\GeneratorCommand;
use InvalidArgumentException;

class MakeRepositoryCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name} {--m=} {--imp} ';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:repository';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /** model name.
     * @var string
     */
    private $modelName;

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/repository.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Repositories';
    }

    protected function replaceNamespace(&$stub, $name)
    {
        if (! $this->option('m')) {
            throw new InvalidArgumentException("Model name is required.\n make:repository RepositoryClassName --m=ModelClass --imp");
        }

        if (strstr($this->option('m'), '\\')) {
            $stub = str_replace(
                ['DummyModel'],
                [$this->option('m')],
                $stub
            );
        } else {
            $stub = str_replace(
                ['DummyModel'],
                ['\\App\\'.'Models\\'.$this->option('m')],
                $stub
            );
        }

        return parent::replaceNamespace($stub, $name); //
    }

    protected function getNamespace($name)
    {
        return parent::getNamespace($name);
    }

    protected function buildClass($name)
    {
        return parent::buildClass($name);
    }

    public function handle()
    {
        $this->modelName = $this->option('m');

        if ($this->option('imp')) {
            $this->createImp();
        }
        if ($this->modelName && ! class_exists($this->modelName)) {
            $this->createModel();
        }

        if (! file_exists(app_path().DIRECTORY_SEPARATOR.'Repositories'.DIRECTORY_SEPARATOR.'BaseRepository.php')) {
            $this->createBaseRepo();
        }
        if (! file_exists(app_path().DIRECTORY_SEPARATOR.'Repositories'.DIRECTORY_SEPARATOR.'BaseRepositoryImp.php')) {
            $this->createBaseRepoImp();
        }
        if (! file_exists(app_path().DIRECTORY_SEPARATOR.'Providers'.DIRECTORY_SEPARATOR.'RepositoryServiceProvider.php')) {
            $this->createRepoServiceProvider();
        }

        return parent::handle();
    }

    /**
     * Create a RepositoryImp for the model.
     *
     * @return void
     */
    protected function createImp()
    {
        $this->call('make:RepositoryImp', [
            'name' => $this->argument('name').'Imp',
        ]);
    }

    /**
     * Create  BaseRepository.
     *
     * @return void
     */
    protected function createBaseRepo()
    {
        $this->call('make:baseRepository', [
            'name' => 'BaseRepository',
        ]);
    }

    protected function createModel()
    {
        if ($this->confirm("A {$this->modelName} model does not exist. Do you want to generate it?", true)) {
            $this->call('make:model', ['name' => $this->modelName]);
        }
    }

    /**
     * Create  BaseRepositoryImp.
     *
     * @return void
     */
    public function createBaseRepoImp()
    {
        $this->call('make:baseRepositoryImp', [
            'name' => 'BaseRepositoryImp',
        ]);
    }

    /**
     * Create  Service provider.
     *
     * @return void
     */
    public function createRepoServiceProvider()
    {
        $this->call('make:repositoryServiceProvider', [
            'name' => 'RepositoryServiceProvider',
        ]);
    }
}
