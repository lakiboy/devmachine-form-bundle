# Bootstrap datetime

## Demo

For quick reference, please, check out this [demo](http://forms.devmachine.net/bootstrap-datetime/).

## Javascript

This form type integrates Bootstrap datetime Javascript library. Read the documentation [here](http://eonasdan.github.io/bootstrap-datetimepicker/).

## Configuration

Default display format is configurable for all datetime types.

```yaml
devmachine_form:
    formats:
        datetime: dd/MM/yyyy HH:mm:ss # default value: yyyy-MM-dd HH:mm
```

Read [more](http://userguide.icu-project.org/formatparse/datetime) about _ICU_ formats.

## Installation with Assetic

You need to include relevant Javascript manually on the page. Find the _Assetic_ example below:

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
                - lib/moment/locale/ru.js
                - lib/eonasdan-bootstrap-datetimepicker/js/bootstrap-datetimepicker.js
```

It is not necessary to use _Assetic_ library. Just make sure relevant _Javascript_ is availbale before `form_javascript` twig block is called. See the [demo](https://github.com/dev-machine/forms-demo) for reference.
