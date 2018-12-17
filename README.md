### Installation 
```$xslt
composer require homicity/laravel-mandrill
```

Then publish the config file

```$xslt
php artisan vendor:publish --provider="Homicity\MandrillMailable\Providers\MandrillMailableServiceProvider" --tag="config"
```

### Config
Add into your .env file
```$xslt
MANDRILL_SECRET={your mandrill api key}
MANDRILL_FROM_EMAIL={your from email address}
MANDRILL_FROM_NAME={your from name}
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
