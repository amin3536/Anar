<?php

namespace amin3520\Anar\Tests;

use amin3520\Anar\Tests\BaseTest;
use amin3520\Anar\Tests\TestSupport\Models\Post;
use amin3520\Anar\Tests\TestSupport\Repositories\PostRepository;
use amin3520\Anar\Tests\TestSupport\Repositories\PostRepositoryImp;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;


use function PHPUnit\Framework\assertEquals;

class RepositoryTest extends BaseTest
{
    protected $postRepo;
    use RefreshDatabase;

   protected function setUp(): void
   {
       parent::setUp();

       $this->loadMigrationsFrom(__DIR__.'/TestSupport/database/migrations');
       $this->artisan('migrate', ['--database' => 'test'])->run();

       $this->app->bind(PostRepositoryImp::class, PostRepository::class);   
       
       $this->postRepo = $this->app->make(PostRepository::class);
   }

   public function testCreateModelInstance()
   {
       $data = Post::factory()->make()->toArray();

       $post = $this->postRepo->create($data);

       $this->assertInstanceOf(Post::class, $post);
       $this->assertDatabaseHas('posts', $data);
   }

   public function testUpdateModelInstance()
   {
       $post = Post::factory()->create();

       $id = $post->id;
       $attributes = [
           'title' => 'update title',
           'text'  => 'update text',
       ];

       $data = array_merge($attributes, ['id' => $id]);

       $result = $this->postRepo->update($attributes, $id);

       $this->assertTrue($result);
       $this->assertDatabaseHas('posts', $data);
   }

   public function testGetAllModelInstance()
   {
       $posts = Post::factory()->times(5)->create();

       $result = $this->postRepo->all();

       assertEquals($posts->get(0)->id, $result->get(0)->id);
       assertEquals($posts->get(1)->id, $result->get(1)->id);
       assertEquals($posts->get(2)->id, $result->get(2)->id);
       assertEquals($posts->get(3)->id, $result->get(3)->id);
       assertEquals($posts->get(4)->id, $result->get(4)->id);


   }

   public function testSortGetAllModelInstance()
   {
       $posts = Post::factory()->times(5)->create();

       $result = $this->postRepo->all(['*'], 'id', 'desc');


       assertEquals($posts->get(4)->id, $result->get(0)->id);
       assertEquals($posts->get(3)->id, $result->get(1)->id);
       assertEquals($posts->get(2)->id, $result->get(2)->id);
       assertEquals($posts->get(1)->id, $result->get(3)->id);
       assertEquals($posts->get(0)->id, $result->get(4)->id);
   }

   public function testSelectGetAllModelInstance()
   {
       $posts = Post::factory()->times(5)->create();

       $result = $this->postRepo->all(['id', 'title', 'text'], 'id', 'desc');


       $result->each(function ($item) {
            $this->assertArrayHasKey('id', $item);
            $this->assertArrayHasKey('title', $item);
            $this->assertArrayHasKey('text', $item);
            $this->assertArrayNotHasKey('status', $item);
            $this->assertArrayNotHasKey('is_published', $item);
        });
   }

   public function testFindModelInstance()
   {
        $post = Post::factory()->create();

        $result = $this->postRepo->find($post->id);

        $this->assertEquals($post->id, $result->id);
        $this->assertEquals($post->title, $result->title);
        $this->assertEquals($post->text, $result->text);
   }

   public function testFindOrFailModelInstance()
   {
        $post = Post::factory()->create();

        $result = $this->postRepo->findOneOrFail($post->id);
        
        $this->assertEquals($post->id, $result->id);
        $this->assertEquals($post->title, $result->title);
        $this->assertEquals($post->text, $result->text);
   }

   public function testFindOrFailThrowsExceptionModelInstance()
   {
        $this->expectException(ModelNotFoundException::class);

        $this->postRepo->findOneOrFail(9999);
   }

   public function testFindByModelWithExistingData()
   {
       $posts = Post::factory()->times(5)->create([
        'title' => 'test'
       ]);

       $searchData = ['title' => 'test'];


       $result = $this->postRepo->findBy($searchData);

       $this->assertCount(5, $result);
       $this->assertEquals($posts[0]->title, 'test');
       $this->assertEquals($posts[0]->id, $result[0]->id);
       $this->assertEquals($posts[0]->text, $result[0]->text);
   }
   
   public function testfindOneByModelWithExistingData()
   {
        $posts = Post::factory()->times(5)->create();

        $searchData = ['id' => $posts[0]->id];

        $result = $this->postRepo->findOneBy($searchData);

        $this->assertNotNull($result);
        $this->assertEquals($posts[0]->id, $result->id);
        $this->assertEquals($posts[0]->title, $result->title);
        $this->assertEquals($posts[0]->text, $result->text);
   }

   public function testFindOneByOrFailWithExistingData()
   {
       $posts = Post::factory()->times(5)->create();

       $searchData = ['id' => $posts[0]->id];

       $result = $this->postRepo->findOneByOrFail($searchData);

       $this->assertEquals($posts[0]->id, $result->id);
       $this->assertEquals($posts[0]->title, $result->title);
       $this->assertEquals($posts[0]->text, $result->text);
   }

   public function testFindOneByOrFailWithNonExistingData()
   {
       $nonExistingSearchData = ['id' => -1];

       $this->expectException(ModelNotFoundException::class);

       $this->postRepo->findOneByOrFail($nonExistingSearchData);
   }

   public function testPaginateArrayResults()
   {
       $data = range(1, 100);

       $paginator = $this->postRepo->paginateArrayResults($data, 10);

       $this->assertInstanceOf(LengthAwarePaginator::class, $paginator);
       $this->assertEquals(100, $paginator->total());
       $this->assertEquals(10, $paginator->perPage());
       $this->assertEquals(1, $paginator->currentPage()); 
       $this->assertEquals(10, count($paginator->items()));
       $this->assertEquals([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], $paginator->items());
   }

   public function testDeleteModelInstance()
   {
        $data = Post::factory()->make()->toArray();

        $post = Post::create($data);

        $this->postRepo->delete($post->id);

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
   }

   public function testFindWhereInstance()
   {
        $posts = Post::factory()->times(5)->create([
            'title' => 'postTest'
        ]);

        $where = ['title' => 'postTest'];


        $result = $this->postRepo->findWhere($where);

        $this->assertCount(5, $result);
        $this->assertEquals($result[0]->title, 'postTest');

        $result->each(function ($item) {
            $this->assertArrayHasKey('id', $item);
            $this->assertArrayHasKey('title', $item);
            $this->assertArrayHasKey('text', $item);
            $this->assertArrayHasKey('status', $item);
            $this->assertArrayHasKey('is_published', $item);
        });
        
   }

   public function testFindWhereColumnsInstance()
   {

    Post::factory()->create([
        'text' => 'testText'
    ]);

    $where = ['text' => 'testText'];

    $result = $this->postRepo->findWhere($where, ['id', 'title', 'text']);

    $this->assertCount(1, $result);

    $result->each(function ($item) {
        $this->assertEquals($item->text, 'testText');
        $this->assertArrayHasKey('id', $item);
        $this->assertArrayHasKey('title', $item);
        $this->assertArrayHasKey('text', $item);
        $this->assertArrayNotHasKey('status', $item);
        $this->assertArrayNotHasKey('is_published', $item);
    });

   }

   public function testFindWhereOrInstanceModel()
   {

    Post::factory()->create([
        'title' => 'titleTest'
    ]);

    Post::factory()->create([
        'text' => 'testText'
    ]);

    $where = ['text' => 'testText', 'title' => 'titleTest'];

    $result = $this->postRepo->findWhere($where, ['id', 'title', 'text'], true);

    $this->assertCount(2, $result);

    $result->each(function ($item) {
        $this->assertArrayHasKey('id', $item);
        $this->assertArrayHasKey('title', $item);
        $this->assertArrayHasKey('text', $item);
        $this->assertArrayNotHasKey('status', $item);
        $this->assertArrayNotHasKey('is_published', $item);
    });

   }

}
