# placeholder
Placeholder images via [placeholder.com](https://placeholder.com/)

## Installation
The (highly) recommended way to install studiow/placeholder is by using [Composer](https://getcomposer.org/)

```bash
composer require studiow/placeholder
```

## Example usage
```php
$image = new Studiow\Placeholder\Image(300, 250);

echo (string) $image; //will write 'https://via.placeholder.com/300x250
```

## Options
We can set different options for our placeholder image. Please note that Image objects are immutable!

The following options are available:
### Dimensions
You can change the width and height
```php
$resized = $image->width($new_width)->height($new_height);
```
### File format
Sets the file format that will be returned. Can be any of 'gif', 'jpg', 'jpeg' or 'png'
```php
$resized = $image->format('jpg');
```
### Colors
We can change the background and foreground color. You must provide a hex color (000 to fff or 000000 to ffffff)
```php
$white_background = $image->background('ffffff');
$black_text = $image->color('000');
```
### Text
By default, the text in the image shows the dimensions (e.g. '300x250'). We can change that, too
```php
$withText = $image->text('My Image Text');
```

