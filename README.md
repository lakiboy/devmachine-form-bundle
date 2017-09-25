# DevmachineFormBundle

[![Build Status](https://travis-ci.org/lakiboy/devmachine-form-bundle.svg?branch=master)](https://travis-ci.org/lakiboy/devmachine-form-bundle) [![Coverage Status](https://coveralls.io/repos/lakiboy/devmachine-form-bundle/badge.svg?branch=master&service=github)](https://coveralls.io/github/lakiboy/devmachine-form-bundle?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lakiboy/devmachine-form-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lakiboy/devmachine-form-bundle/?branch=master) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/b774b740-3eca-4084-ac1f-2aee3129ee47/mini.png)](https://insight.sensiolabs.com/projects/b774b740-3eca-4084-ac1f-2aee3129ee47)

Symfony form extensions for Bootstrap date/datetime widgets, typeahead based autocomplete and other helpers.

## Update 2017

In modern world of React, Angular and Vue there is no much point in solutions like this. Use your favourite front-end framework + Symfony API.

## Installation

Install this bundle using Composer. Add the following to your composer.json for Symfony 3.0+:

```javascript
{
    "require": {
        "devmachine/form-bundle": "~2.0"
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

 - [Bootstrap date](https://github.com/lakiboy/devmachine-form-bundle/blob/master/Resources/doc/date.md)
 - [Bootstrap datetime](https://github.com/lakiboy/devmachine-form-bundle/blob/master/Resources/doc/datetime.md)
 - [Twitter typeahead](https://github.com/lakiboy/devmachine-form-bundle/blob/master/Resources/doc/typeahead.md)
 - [Choices](https://github.com/lakiboy/devmachine-form-bundle/blob/master/Resources/doc/choices.md)
