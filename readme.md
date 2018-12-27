# Anar

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

Anar is artisan command to create fast repository for your amazing app . Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require amin3520/anar
```


## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## command

``` bash
$ php artisan make:repository name  --m=model_name --imp 
 #sample php artisan make:repository UserRepository --m=User --imp
```
```  name ``` is your name Repository ,

```  --m ```option is  model name that use in repo and it is necessary input

```  --imp ``` create interface for your repo


first run of command create base files and directory ,you can see them below

``` bash

|--Providers
|       |--RepositoryServiceProvider.php
|
|--Repositories
|       |--BaseRepository.php
|       |--BaseRepositoryImp.php
|       |//and other your repoitorys
```


### _Configuration_

if you want inject your repositories in some constructor like controllers ,add repo name 
in ```$names``` in ```Providers/RepositoryServiceProvider.php```

```php
  /**
     * Register RepositoryServiceProvider  .
     * provide your repository and inject it any where below your app directoy, like in to your controller's app if you want to use it
     * @return void
     */
    public function register()
    {
         $names = [
               //add Begin your repository name here   like -> 'UserRepository',
            ];

            foreach ($names as $name) {
                $this->app->bind(
                    "App\\Repositories\\{$name}", pro
                    "App\\Repositories\\{$name}");
            }


    }
```

### _Usage_

```php
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    private $userRepo;

    /**
     * Controller constructor.
     *inject repo by service provider
     */
    public function __construct(UserRepositoryImp $repositoryImp)
    {
        $this->userRepo=$repositoryImp;
        //now u can use it
    }

    public function updateName(Request $request)
    {
        $this->userRepo->update(['name'=>'amin'],auth::id());
    }
}
```


## _BaseMethods_

Base repository has some useful method you can use theme  s
```php
interface BaseRepositoryImp
{
    public function create(array $attributes);
    public function update(array $attributes, int $id);
    public function all($columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc');
    public function find(int $id);
    public function findOneOrFail(int $id);
    public function findBy(array $data);
    public function findOneBy(array $data);
    public function findOneByOrFail(array $data);
    public function paginateArrayResults(array $data, int $perPage = 50);
    public function delete(int $id);
}
```
![methods][methods]


## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.


## Task list:

- [ ] add Test 
- [ ] add dynamic directory option 
- [ ] add dynamic directory for pickUp mode




## License

MIT License. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/amin3520/anar.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/amin3520/anar.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/amin3520/anar/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/amin3520/anar
[link-downloads]: https://packagist.org/packages/amin3520/anar
[link-travis]: https://travis-ci.org/amin3520/anar
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/amin3520
[link-contributors]: ../../contributors]
[methods]:https://imgur.com/a/dW7rUnr

