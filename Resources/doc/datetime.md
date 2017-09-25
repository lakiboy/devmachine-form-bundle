# Bootstrap datetime

## Javascript

This form type integrates _Bootstrap_ datetime _Javascript_ library. Read the documentation [here](http://eonasdan.github.io/bootstrap-datetimepicker/).

## Configuration

Default display format is configurable for all datetime types.

```yaml
devmachine_form:
    formats:
        datetime: dd/MM/yyyy HH:mm:ss # default value: yyyy-MM-dd HH:mm
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
                - lib/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css
        forms_js:
            inputs:
                - lib/jquery/jquery.js
                - lib/bootstrap/js/bootstrap.js
                - lib/moment/moment.js
                - lib/eonasdan-bootstrap-datetimepicker/js/bootstrap-datetimepicker.js
```

It is not necessary to use _Assetic_ library. Just make sure relevant _Javascript_ is availbale before `form_javascript` twig block is called.

## Form options

```php
use Devmachine\Bundle\FormBundle\Form\Type\DateTimeType;

$builder->add('field', DateTimeType::class, [
    'format'      => 'dd-MM-yyyy HH:mm', // Configurable per project in config.
    'input_addon' => false,              // Render input add-on (see the demo).
    'inline'      => false,              // Render inline calendar (see the demo).
    'locale'      => 'ru',               // Make sure to include relevant Javascript translation on the page.
    'config'      => [                   // Bootstrap datetime config options (link below).
        'calendarWeeks'   => true,
        'showTodayButton' => true,
        'showClear'       => true,
        'showClose'       => true,
    ],
]);
```

See the full list of _Javascript_ [config options](http://eonasdan.github.io/bootstrap-datetimepicker/Options/).
