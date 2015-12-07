# Bootstrap date

## Demo

For quick reference, please, check out this [demo](http://forms.devmachine.net/).

## Javascript

This form type integrates Bootstrap date Javascript library. Read the documentation [here](http://bootstrap-datepicker.readthedocs.org/).

## Configuration

Default display format is configurable for all date types. Allowed _ICU_ values are _y_, _M_ and _d_:

```yaml
devmachine_form:
    formats:
        date: dd/MM/y # default value: yyyy-MM-dd
```
        
Read [more](http://userguide.icu-project.org/formatparse/datetime) about _ICU_ formats.

## Installation with Assetic

You need to include relevant Javascript manually on the page. Find the _Assetic_ example below:

```yaml
assetic:
    ...
    
    assets:
        ...
    
        forms_css:
            ...
        
            inputs:
                - lib/bootstrap/css/bootstrap.css
                - lib/bootstrap-datepicker/css/bootstrap-datepicker3.css
        forms_js:
            ...
        
            inputs:
                - lib/jquery/jquery.js
                - lib/bootstrap/js/bootstrap.js
                - lib/bootstrap-datepicker/js/bootstrap-datepicker.js
```

It is not necessary to use _Assetic_ library. Just make sure relevant _Javascript_ is availbale before `form_javascript` twig block is called. See the demo for reference.



