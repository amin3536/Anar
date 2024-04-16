<?php

namespace amin3520\Anar\Tests;

use App\Models\TestModel;
use Illuminate\Console\OutputStyle;
use Illuminate\Support\Facades\File;
use Mockery;

class MakeRepositoryCommandTest extends BaseTest
{
    protected $basePath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->basePath = app_path().DIRECTORY_SEPARATOR . 'Repositories';
    }

    protected function tearDown(): void
    {
        // Cleanup: Remove the directories and files created during the test
        File::deleteDirectory($this->basePath);
        parent::tearDown();
    }

    public function testRepositoryStubGeneration(): void
    {
        $this->artisan('make:model', ['name' => 'TestModel']);
        $this->artisan('make:repository', ['name' => 'TestRepository', '--m' => 'TestModel', '--imp' => true]);

      

        $expectedFiles = [
            "{$this->basePath}/BaseRepository.php",
            "{$this->basePath}/BaseRepositoryImp.php",
            "{$this->basePath}/TestRepository.php",
            "{$this->basePath}/TestRepositoryImp.php",
            // test model is exsist
            app_path().DIRECTORY_SEPARATOR .'Models'. DIRECTORY_SEPARATOR .'TestModel.php',
        ];

        foreach ($expectedFiles as $file) {
            $this->assertFileExists($file);
        }

    }
}
