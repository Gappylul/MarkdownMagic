# Welcome to My Blog!

This post demonstrates various **Markdown** and _formatting_ features.

## Code Examples

Here's a PHP example:

```php
public function index()
{
    $posts = Post::with('user')
        ->latest()
        ->paginate(10);
    
    return view('posts.index', compact('posts'));
}
```

And some JavaScript:

```javascript
const fetchData = async () => {
    try {
        const response = await fetch('/api/data');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error:', error);
    }
}
```

## Lists and Links

### Unordered List
- First item
- Second item
  - Nested item
  - Another nested item
- Third item

### Ordered List
1. First step
2. Second step
3. Third step

## Links and Images

Visit [Laravel's website](https://laravel.com) for more information.

## Blockquotes

> "The best way to predict the future is to invent it."
> - Alan Kay

## Tables

| Feature | Support |
|---------|---------|
| Tables | ✅ |
| Code Blocks | ✅ |
| Lists | ✅ |
| Links | ✅ |

## Task Lists

- [x] Write the blog post
- [x] Add code examples
- [ ] Add more features
- [ ] Publish

## Emphasis and Highlighting

You can use *italic* or _italic_, **bold** or __bold__, and even ***bold italic*** text.

## Technical Details

Here's a bash command:

```bash
php artisan make:controller BlogController --resource
```

And some CSS:

```css
.prose {
    max-width: 65ch;
    color: #374151;
}

.dark .prose {
    color: #e5e7eb;
}
```

---

That's all for now! Hope this helps demonstrate the markdown capabilities. 