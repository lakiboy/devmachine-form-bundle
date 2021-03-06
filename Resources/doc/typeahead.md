# Twitter typeahead

## Javascript

This form type integrates _Twitter_ typeahead _Javascript_ library. Read the documentation [here](https://github.com/twitter/typeahead.js/blob/master/doc/jquery_typeahead.md).

## Installation with Assetic

You need to include relevant _Javascript_ manually on the page. Find the _Assetic_ example below:

```yaml
assetic:
    assets:
        forms_css:
            inputs:
                - lib/bootstrap/css/bootstrap.css
                - lib/typeahead.js-bootstrap3.less/typeahead.css
        forms_js:
            inputs:
                - lib/jquery/jquery.js
                - lib/typeahead.js/typeahead.bundle.js
```

It is not necessary to use _Assetic_ library. Just make sure relevant _Javascript_ is availbale before `form_javascript` twig block is called.

## Form options

This integration supports core _Typeahead_ functionality i.e. without _Bloodhound_ suggestion engine.

```php
use Devmachine\Bundle\FormBundle\Form\Type\TypeaheadType;

$builder->add('movie', TypeaheadType::class, [
    'source_name' => 'movies', // Name of typeahead source.

    // https://github.com/twitter/typeahead.js/blob/master/doc/jquery_typeahead.md#options
    'hint'        => true,     // If false, the typeahead will not show a hint.
    'highlight'   => true,     // Pattern matches for the current query in text.
    'min_length'  => 3,        // The min length needed before suggestions start getting rendered.
    'class_names' => [],       // https://github.com/twitter/typeahead.js/blob/master/doc/jquery_typeahead.md#class-names

    // https://github.com/twitter/typeahead.js/blob/master/doc/jquery_typeahead.md#datasets
    'source'    => [],         // Data set: array of values or array of hashes, empty for Ajax typeaheads.
    'limit'     => 5,          // Limit amount of results.
    'value_key' => null,       // Hash key of data source item to be used as suggestion value.
    'label_key' => null,       // Hash key of data source item to be used as suggestion label.
    'matcher'   => 'contains', // Allowed values: contains, starts_with, ends_with

    'route_name'   => null,    // Route name for Ajax typeaheads.
    'route_params' => [],      // Route params for Ajax typeaheads.
])
```

At the moment only single data source is suppored.

There are 2 predefined typeaheads: [TypeaheadTimezoneType](https://github.com/lakiboy/devmachine-form-bundle/blob/master/Form/Type/TypeaheadTimezoneType.php) and [TypeaheadCountryType](https://github.com/lakiboy/devmachine-form-bundle/blob/master/Form/Type/TypeaheadCountryType.php). Both form types are good examples for non-Ajax suggestions.
