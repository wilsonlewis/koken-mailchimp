<?php

class MailchimpPlugin extends KokenPlugin
{
    /**
     * Template for rendering a Mailchimp subscribe image.
     *
     * @var string
     */
    protected $template;

    /**
     * A pattern to find and replace 'mailchimp' tags.
     *
     * @var string
     */
    protected $tag;

    /**
     * Create a new Mailchimp Plugin instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->template = file_get_contents(__DIR__.'/assets/views/main.html');

        $this->tag = '/<(\s*?)mailchimp(.*?)>(.*?)<(\s*?)\/mailchimp(\s*?)>/';

        $this->register_hook('before_closing_head', 'insertMailchimpStyles');
        
        $this->register_filter('site.output', 'insertMailchimp');
    }

    /**
     * Append default styles to the <head> tag.
     *
     * @return void
     */
    public function insertMailchimpStyles()
    {
        echo '<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">';
        echo '<style>'.file_get_contents(__DIR__.'/assets/css/main.css').'</style>';
        echo '<script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us16.list-manage.com","uuid":"33485be8ac883b6e491f29330","lid":"29770146c7"}) })</script>';
        echo '<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/33485be8ac883b6e491f29330/feb9ab734c57e9fd4991ee90c.js");</script>';
    }

    /**
     * Replace any 'mailchimp' tags found in a page before it is rendered.
     *
     * @see   $this->replaceMailchimpTag()
     *
     * @param  string $content
     *
     * @return string
     */
    public function insertMailchimp($content)
    {
        return preg_replace_callback($this->tag, array($this, 'replaceMailchimpTag'), $content);
    }

    /**
     * Replaces any 'mailchimp' tag found in html markup with a mailchimp form.
     *
     * Example: '<mailchimp url="**url**"></mailchimp>'
     *
     * @param  array $matches
     *
     * @return string
     */
    protected function replaceMailchimpTag($matches)
    {
        $attributes = (new SimpleXMLElement('<element '.$matches[2].' />'))->attributes();

        return $this->replaceTemplateVariables($this->template, [
            'url' => $attributes['username'] ?: $this->data->url
        ]);
    }

    /**
     * Replaces multiple variables in a template with values.
     *
     * @see    $this->replaceTemplateVariable()
     *
     * @param  string $template
     * @param  array $variables
     *
     * @return string
     */
    protected function replaceTemplateVariables($template, $variables)
    {
        foreach ($variables as $name => $value) {
            $template = $this->replaceTemplateVariable($template, $name, $value);
        }

        return $template;
    }

    /**
     * Replaces variables in a template with values using handlebar syntax.
     *
     * Example: 'Hello, {{ name }}!', 'name', 'world'
     *
     * Result: 'Hello, world!'
     *
     * @param  string $template
     * @param  array $variables
     *
     * @return string
     */
    protected function replaceTemplateVariable($template, $name, $value)
    {
        return preg_replace('/\{\{(\s*?)'.$name.'(\s*?)\}\}/', $value, $template);
    }
}
