# Bootstrap date

## Javascript

This form type integrates _Bootstrap_ date _Javascript_ library. Read the documentation [here](http://bootstrap-datepicker.readthedocs.org/).

## Configuration

Default display format is configurable for all date types. Allowed _ICU_ values are _y_, _M_ and _d_:

```yaml
devmachine_form:
    formats:
        date: dd/MM/y # default value: yyyy-MM-dd
```

Read [more](http://userguide.icu-project.org/formatparse/datetime) about _ICU_ formats.

## Installation with Assetic

You need to include relevant _Javascript_ manually on the page. Find the _Assetic_ example below:

```yaml
assetic:
    assets:
        forms_css:
            inputs:
                - lib/bootstrap/css/bootstrap.css
                - lib/bootstrap-datepicker/css/bootstrap-datepicker3.css
        forms_js:
            inputs:
                - lib/jquery/jquery.js
                - lib/bootstrap/js/bootstrap.js
                - lib/bootstrap-datepicker/js/bootstrap-datepicker.js
```

It is not necessary to use _Assetic_ library. Just make sure relevant _Javascript_ is availbale before `form_javascript` twig block is called.

## Form options

```php
use Devmachine\Bundle\FormBundle\Form\Type\DateType;

$builder->add('field', DateType::class, [
    'format'      => 'dd-MM-yyyy', // Configurable per project in config.
    'input_addon' => false,        // Render input add-on (see the demo).
    'inline'      => false,        // Render inline calendar (see the demo).
    'locale'      => 'ru',         // Make sure to include relevant Javascript translation on the page.
    'config'      => [             // Bootstrap date config options (link below).
        'clearBtn'       => true,
        'orientation'    => 'top',
        'todayHighlight' => true,
    ],
]);
```

See the full list of _Javascript_ [config options](http://bootstrap-datepicker.readthedocs.org/en/latest/options.html).
