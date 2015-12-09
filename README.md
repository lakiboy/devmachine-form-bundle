# DevmachineFormBundle

[![Build Status](https://travis-ci.org/dev-machine/DevmachineFormBundle.svg?branch=master)](https://travis-ci.org/dev-machine/DevmachineFormBundle) [![Coverage Status](https://coveralls.io/repos/dev-machine/DevmachineFormBundle/badge.svg?branch=master&service=github)](https://coveralls.io/github/dev-machine/DevmachineFormBundle?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dev-machine/DevmachineFormBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dev-machine/DevmachineFormBundle/?branch=master) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/b774b740-3eca-4084-ac1f-2aee3129ee47/mini.png)](https://insight.sensiolabs.com/projects/b774b740-3eca-4084-ac1f-2aee3129ee47)

Symfony form extensions for Bootstrap date/datetime widgets, typeahead based autocomplete and other helpers. 

Visit [demo](http://forms.devmachine.net) website to view all available form types in action.

__Supports Symfony 2.3+ and 3.0+ versions.__ Browse [documentation](https://github.com/dev-machine/DevmachineFormBundle/tree/1.0) for Symfony 2.x.

## Installation 

Install this bundle using Composer. Add the following to your composer.json for Symfony 3.0+:

```javascript
{
    "require": {
        "devmachine/form-bundle": "~2.0"
    }
}
```

For Symfony 2.3+:

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
    $bundles = [
        // ...

        new Devmachine\Bundle\FormBundle\DevmachineFormBundle(),
    ];
}
```

## Integration

To add _Javascript_ support to the form with _devmachine_ type(s) `form_javascript` twig block must be called.

```twig
{% extends 'AppBundle::layout.html.twig' %}

{% block content %}
    {{ form_start(form) }}
    {{ form_widget(form) }}
    {{ form_end(form) }}
{% endblock %}

{# Put this block in parent template somewhere at the bottom of page. #}
{% block javascripts %}
    {{ form_javascript(form) }}
{% endblock %}
```

The approach used is same as in famous _GenemuFormBundle_. 

__Note__: it is safe to use both _DevmachineFormBundle_ and _GenemuFormBundle_ in one project.

## Documentation

Topics:

 - [Bootstrap date](https://github.com/dev-machine/DevmachineFormBundle/blob/master/Resources/doc/date.md)
 - [Bootstrap datetime](https://github.com/dev-machine/DevmachineFormBundle/blob/master/Resources/doc/datetime.md)
 - [Twitter typeahead](https://github.com/dev-machine/DevmachineFormBundle/blob/master/Resources/doc/typeahead.md)
 - [Choices](https://github.com/dev-machine/DevmachineFormBundle/blob/master/Resources/doc/choices.md)
