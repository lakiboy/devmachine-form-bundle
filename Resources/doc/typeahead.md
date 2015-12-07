# Bootstrap typeahead

## Demo

For quick reference, please, check out this [demo](http://forms.devmachine.net/typeahead/).

## Javascript

This form type integrates Twitter typeahead Javascript library. Read the documentation [here](https://github.com/twitter/typeahead.js/blob/master/doc/jquery_typeahead.md).

## Installation with Assetic

You need to include relevant Javascript manually on the page. Find the _Assetic_ example below:

```yaml
assetic:
    assets:
        forms_css:
            inputs:
                - lib/bootstrap/css/bootstrap.css
                - lib/typeahead.js-bootstrap3.less/typeahead.css
            filters:
                - cssrewrite
                - ?scssphp
        forms_js:
            inputs:
                - lib/jquery/jquery.js
                - lib/typeahead.js/typeahead.bundle.js
```

It is not necessary to use _Assetic_ library. Just make sure relevant _Javascript_ is availbale before `form_javascript` twig block is called. See the [demo](https://github.com/dev-machine/forms-demo) for reference.
