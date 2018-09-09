# Nova Translatable Macro

Adds the ability to show and edit translated fields created with [spatie/laravel-translatable](https://github.com/spatie/laravel-translatable) package.

## Installation and usage
Require Nova 1.0.13+

You can require this package using composer:
```
composer require kabbouchi/nova-translatable
```

You can add the field follows:
```
Text::make('Name')->translatable(),
TextArea::make('Description')->translatable(),
```

## Support

- [x] Text
- [x] Text Area
- [ ] Trix
- [ ] File
- [ ] Timezone
- [ ] Number
- [ ] Date
- [ ] DateTime
- [ ] ...