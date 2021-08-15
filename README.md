# Formidable WP AJAX

This plugin helps fetch the data in table format from [endpoint](https://api.strategy11.com/wp-json/challenge/v1/1) with time intervals of one hour.

Have also added an option to override the one-hour limit and manually fetch the new data by clicking on a single button in the backend.

One can also override the hour limit using the WP CLI command since have also integrated WP CLI as well.

Have also created the facility to add table data in the frontend using shortcode inside any page.

Also added PHPunit test cases to validate the AJAX data.


## Installation

1. Upload the `formidable-wp-ajax` folder to your `/wp-content/plugins/` directory
2. Activate the plugin via the Plugins menu in WordPress
3. Please make sure you'r setup are on or above WP version 4.9 and PHP version 5.6.0
4. Upon activation it will fetch the data in table format under admin menu **Formidable WP AJAX**.


## Screenshots

1. Backend Data Listing page.

  ![Screenshot](https://github.com/upeshv/formidable-wp-ajax/blob/master/assets/images/Data_listing_backend.png?raw=true)

2. Settings page (Shortcode info).

  ![Screenshot](https://github.com/upeshv/formidable-wp-ajax/blob/master/assets/images/shortcode_page.png?raw=true)

3. Frontend page.

  ![Screenshot](https://github.com/upeshv/formidable-wp-ajax/blob/master/assets/images/Data_listing_frontend.png?raw=true)


## CLI command to refresh data

Using Below command you can override the one-hour limit and manually fetch the new data.
Setps to install [WPCLi](https://wp-cli.org/#installing)

```php
  wp frm-wp-ajax-reset
```

**WP-CLI Success message.**

![Screenshot](https://github.com/upeshv/formidable-wp-ajax/blob/master/assets/images/WP-CLI_Success.png?raw=true)


## PHPunit Test Cases

Have created to two test cases where in test-ajax-hook it check whether the ajax action is hooked properly or not.

```php
  phpunit // It will run all test cases together
```

And in second test case test-ajax-get-data check the expected results and also checking whether the ajax request runs once per hour or multiple times.

```php
  phpunit --group ajax // For running ajax specific test cases
```

**PHPunit Success message.**

![Screenshot](https://github.com/upeshv/formidable-wp-ajax/blob/master/assets/images/phpunit_test_cases.png?raw=true)


## Shortcode

Below shortcode is used to display table data in frontend.

```php
  [frmwpajax]
```


## Compatibility and security

* Have followed the defined [WordPress coding standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/)
* All the Data is been Sanitized, Escaped, and Validated.
* The plugin is compatible with WordPress version 4.9 and latest and PHP versions 5.6.0 and latest.
* WCAG 2.0 Compatibility.
* The plugin is translation-ready.
* The plugin is licensed as GPL v2 or later.
* It is not accessible directly by browsing the plugin's directory.


## License
[GPL-2.0+](https://www.gnu.org/licenses/gpl-2.0.html)


<br>
<br>
**Happy Coding :smiley:**