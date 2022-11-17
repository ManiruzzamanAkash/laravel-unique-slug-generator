# Laravel-unique-slug-generator
A simple but beautiful unique slug generator for Laravel eloquent model.

---

## Installation

```sh
composer require maniruzzaman/laravel-unique-slug
```

## Use from Controller

#### Import first the UniqueSlug facade
```php
use Akash\LaravelUniqueSlug\Facades\UniqueSlug;
```
### Example #01- Post unique slug from title

Let's assume, we have in `Post` class, we've added `slug` column which is unique. Now, if we passed `title` and generate `slug` from that, then -

```php
use App\Models\Post;

// First time create post with title Simple Post
UniqueSlug::generate(Post::class, 'Simple Post', 'slug');
// Output: simple-post

// Second time create post with title Simple Post
UniqueSlug::generate(Post::class, 'Simple Post', 'slug');
// Output: simple-post-1

// Third time create post with title Simple Post
UniqueSlug::generate(Post::class, 'Simple Post', 'slug');
// Output: simple-post-2
```

### Example #02 - Pass custom separator

Let's assume separator is `''` empty.

```php
// First time create user.
UniqueSlug::generate(User::class, 'akash', 'username', ''); // akash

// Second time create user.
UniqueSlug::generate(User::class, 'akash', 'username', ''); // akash1

// Third time create user.
UniqueSlug::generate(User::class, 'akash', 'username', ''); // akash2
```

### Example - Unique slug for category or any model easily
```php
public function create(array $data): Category|null
{
    if (empty($data['slug'])) {
        $data['slug'] = UniqueSlug::generate(Category::class, $data['name'], 'slug');
    }

    return Category::create($data);
}
```

## API Docs

### Generate method -
```php
UniqueSlug::generate($model, $value, $field, $separator);
```

```php
/**
 * Generate a Unique Slug.
 *
 * @param object $model
 * @param string $value
 * @param string $field
 * @param string $separator
 *
 * @return string
 * @throws \Exception
 */
public function generate(
    $model,
    $value,
    $field,
    $separator = null
): string

```

#### Publish configuration
```sh
php artisan vendor:publish akash/laravel-unique-slug
```

#### Configurations

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Slug default separator.
    |--------------------------------------------------------------------------
    |
    | If no separator is passed, then this default separator will be used as slug.
    |
    */
    'separator' => '-',

    /*
    |--------------------------------------------------------------------------
    | Slug max count limit
    |--------------------------------------------------------------------------
    |
    | Default 100, slug will generated like
    | test-1, test-2, test-3 .... test-100
    |
    */
    'max_count' => 100,
];

```

## Contribution
You're open to create any Pull request.
