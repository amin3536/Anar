<?php

namespace amin3520\Anar\Tests\TestSupport\Repositories;

use amin3520\Anar\Tests\TestSupport\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class PostRepository extends BaseRepository implements PostRepositoryImp
{
      /**
           * PostRepository constructor.
           * @param \Illuminate\Database\Eloquent\Model $model
           */
        public function __construct(Post $model)
        {
              parent::__construct($model);

        }
}
