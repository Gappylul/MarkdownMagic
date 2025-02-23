<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BlogSeeder extends Seeder
{
    public function run()
    {
        // Create some users
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Bob Wilson',
                'email' => 'bob@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);
            
            // Create 5 blogs for each user
            for ($i = 1; $i <= 5; $i++) {
                Blog::create([
                    'user_id' => $user->id,
                    'title' => "Blog Post {$i} by {$user->name}",
                    'content' => "# Welcome to my blog post {$i}!\n\n" .
                        "This is a sample blog post with [markdown links](https://example.com) and some **bold text**.\n\n" .
                        "## Features\n\n" .
                        "- Markdown support\n" .
                        "- [External links](https://www.google.com)\n" .
                        "- Code blocks\n\n" .
                        "```php\n" .
                        "echo 'Hello World';\n" .
                        "```\n\n" .
                        "Visit my [GitHub](https://github.com) profile for more!",
                    'slug' => "blog-post-{$i}-by-" . \Str::slug($user->name),
                ]);
            }
        }
    }
} 