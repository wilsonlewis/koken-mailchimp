<p align="center">
    <a href="http://koken.me">
        <img src="http://koken.me/img/koken-logo-head.svg" data-png-fallback="http://koken.me/img/koken-logo-head.png" alt="Koken" width="64" height="64">
    </a>
</p>

## About

A <a href="http://koken.me">Koken</a> plugin to easily add a <a href="http://mailchimp.com">Mailchimp</a> newsletter subscription form.

- <a href="http://koken.me">Koken</a> is a CMS focused on photography
- <a href="http://mailchimp.com">Mailchimp</a> is a common photo-sharing application

## Installation

Koken does not have a store for 3rd party plugins, so we need to install it manually.

- <a href="http://koken.me/#dlkoken">Install Koken</a>
- Navigate to the plugins folder:

        cd /storage/plugins

- Git clone or download and unzip this package:
        
        git clone https://github.com/wilsonlewis/koken-mailchimp.git
        
- Open a new browser window to login to your admin plugins section: 

        http://yoursite.com/admin/#/settings/plugins

- Click the **Enable** button next to this plugin to enable
- Click the **Set up** button to add a Mailchimp form url


## Markup

Add a form using an 'mailchimp' tag in an <a href="http://help.koken.me/customer/portal/articles/632095-text-overview">essay or custom page</a>.

        // using global settings
        <mailchimp></mailchimp>
        
        // using optional overrides
        <mailchimp url="url"></mailchimp>
        
It can also be used in any <a href="http://help.koken.me/customer/portal/articles/828688-lens-templates">.lens template</a>.

## Attributes

url

- type: string
- value: the url of your mailchimp form
- default: null (set globally in plugin settings)

## License

This plugin is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).