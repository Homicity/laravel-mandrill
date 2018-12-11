### Installation 
```$xslt
composer require homicity/laravel-mandrill
```

Then publish the config file

```$xslt
php artisan vendor:publish --provider="Homicity\MandrillMailable\Providers\MandrillMailableServiceProvider" --tag="config"
```

### Config
Add in your .env
```$xslt
MANDRILL_SECRET=your-api-key
```

### Usage

```$xslt
Mail::mandrill()
    ->to('john@example.com')
    ->name('John Doe')
    ->templateName('template-name')
    ->fromEmail('no-reply@example.com')
    ->fromName('Example Website')
    ->subject('Hello Mandrill')
    ->send();
```
