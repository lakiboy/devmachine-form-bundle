# DevmachineFormBundle

[![Build Status](https://travis-ci.org/dev-machine/DevmachineFormBundle.svg?branch=master)](https://travis-ci.org/dev-machine/DevmachineFormBundle) [![Coverage Status](https://coveralls.io/repos/dev-machine/DevmachineFormBundle/badge.svg?branch=master&service=github)](https://coveralls.io/github/dev-machine/DevmachineFormBundle?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dev-machine/DevmachineFormBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dev-machine/DevmachineFormBundle/?branch=master) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/b774b740-3eca-4084-ac1f-2aee3129ee47/mini.png)](https://insight.sensiolabs.com/projects/b774b740-3eca-4084-ac1f-2aee3129ee47)

Symfony form extensions. [Demo](http://forms.devmachine.net).

## Installation 

Install this bundle using Composer. Add the following to your composer.json:

```javascript
{
    "require": {
        "devmachine/form-bundle": "~1.0"
    }
}
```

Register bundle in the kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...

        new Devmachine\Bundle\OntheioBundle\DevmachineFormBundle(),
    );
}
```


