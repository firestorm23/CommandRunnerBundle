Fork information
===================
This is fork of borNfreee/CommandRunnerBundle. I fixed the issue with wrong work of non-value command parameters. 

CommandRunnerBundle
===================

Executes Symfony2 console command from Controller (HTTP request).

Installation
------------

This bundle is available on [Packagist](https://packagist.org/packages/mrafalko/command-runner-bundle):

To install it, run:

    $ composer require mrafalko/command-runner-bundle:dev-master

Then add the bundle to `app/AppKernel.php`:

```php
public function registerBundles()
{
    return array(
        ...
        new Mrafalko\CommandRunnerBundle\MrafalkoCommandRunnerBundle(),
        ...
    );
}
```

Then import routing file:

```yaml
# app/config/routing.yml
mrafalko_command_runner:
    resource: "@MrafalkoCommandRunnerBundle/Controller/CommandRunnerController.php"
    type: annotation
    prefix:   /
```

Examples
------------

Run the command from your URL:

http://yourdomain.dev/command-runner/your:command:name
