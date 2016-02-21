# Rage

> Do not go gentle into that good night,  
> Old age should burn and rave at close of day;  
> Rage, rage against the dying of the light.  
>  
> &mdash; <cite>Dylan Thomas</cite>

This theme bucks the WordPress way of handling templates to significantly reduce the amount of markup required to write a custom theme.

> F--- you I won't do what you tell me  
>  
> &mdash; <cite>Killing In The Name</cite>

#### Features

* Wrapper & Layout Templates
* Widget Templates
* Simplified WP Hierarchy Templates
* SASS
* Bootstrap   
* bbPress Support

### Folder Structure 

* **assets** - CSS and javascript files
    * **js** - Location for all Javascript related to this theme.
    * **css** - Location for 3rd-Party CSS used by this theme.
    * **sass** - Location for all SCSS files used by this theme.
* **includes** - WordPress hooks and other PHP functions and classes used by this theme.
    * **rage** - Location of theme provided utilities.
    * **vendor** - Location for 3rd party PHP libraries.
* **templates** - Location of templates that may be used by the Page post type.
    * **widgets** - Template location for widgets.
    * **wrappers** - Template location for wrappers and layouts.

### Theme Files

File | Description
---|---
`style.css` | Contains theme details (meta data) and the main site css.
`style.scss` | Main theme sass file
`functions.php` | Loads files from the `includes` folder.
`includes/bbpress-tweaks.php` | bbPress hooks and filters.
`includes/content-tweaks.php` | General WordPress content hooks and filters.
`includes/structure.php` | Configuration file for the theme
 

### Template Hierarchy Files

These templates define the theme layout for different types of pages throughout the site. **Template Hierarchy files must be located in the root of your theme.** 

File | Description
---|---
`404.php` | Page not found - shown when the requested URL is not found within WordPress.
`archive.php` | Wrapper for a list of posts when viewing a category or tag.
`comments.php` | Template that wraps comment output and provides the comment form. 
`front-page.php` | Template for the site's home page. 
`home.php` | Template used to render the blog posts index, whether it is being used as the front page or on separate static page.  
`page.php` | Wrapper template for an individual Page. 
`search.php` | Wrapper for a list of search results.
`single.php` | Wrapper for an individual content of a custom post_type.   
`index.php` | `(empty)` The final fall-back when no appropriate template is found. Since we have covered the main template hierarchy with other files, this has been intentionally left blank. 

More more information of additional template files, review the [Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/).

### Template Files

These templates are used to output the actual content.

File | Description
---|---
`templates/wrappers/wrapper.php` | Default wrapper template for the outer most HTML of the document. Normally includes the html, head, and body elements.
`templates/wrappers/layout.php` | Default layout template. Normally includes content area and sidebar.
`templates/wrappers/layout-no-sidebar.php` | Layout with no sidebar.
`templates/widgets` | @see Widget Templates.
`templates/content.php` | Default content template used when a more appropriate one can't be found.
`templates/content-no-results.php` | Template used when no posts are found for the page.
`templates/content-page.php` | Template used to display the content of a Page. 
`templates/content-post.php` | Template used to display the content of a Post.
`templates/content-search.php` | Template used to display a single search result in a list of search results.
`templates/entry-author.php` | Template to display "About the Author" information.
`templates/entry-footer.php` | Template for common footer data.
`templates/entry-meta.php` | Template for post date, time, and author info
`templates/entry-navigation.php` | Template for post navigation (Next Post, Previous Post).
`templates/entry-pager.php` | Template for single post pager. Posts can be broken into pages by using the `<!--nextpage-->` tag in the content body.
`templates/entry-taxonomy.php` | Template used to display Categories and Tags related to the current post. 
`templates/entry-thumbnail-fancy.php` | Template for showing a large version of the Featured Image on a post.
`templates/header.php` | Default template for the beginning of the HTML document. Normally includes the site header nad main navigational menu.
`templates/footer.php` | Default template for the end of the HTML document. Normally includes a copyright date and some additional site information. 
`templates/sidebar.php` | Default wrapper template for sidebar widgets. 


### Content Template Patterns

These patterns can be used to create more-specific content templates.

Pattern | Description
---|---
`templates/content-{post_type}.php` | Like `content.php`, but this template handles content for a custom post_type. Example: `templates/content-gallery_item.php`
`templates/content-post-{post_format}.php` | Like `content-post.php`, but this template is for a specific post_format. Example: `templates/content-post-video.php`
`templates/entry-footer-{post_type}.php` | Like `entry-footer.php`, but this template is for a specific post_type. Example: `templates/entry-footer-gallery_item.php`
`templates/entry-meta-{post_type}.php` | Like `entry-meta.php`, but this template is for a specific post_type. Example: `entry-meta-gallery_item.php`

### Widget Templates

Templating provided by [Sweet Widgets Templates](https://github.com/daggerhart/sweet-widgets/tree/master/modules/widget-templates).


#### Widget Template Patterns

These patterns can be used to create more-specific widget templates.

Pattern | Description
---|---
`templates/widgets/{sidebar-id}--{widget-id}.php` | Specific widget in specific sidebar.
`templates/widgets/{sidebar-id}--default.php` | Any widget in a specific sidebar.
`templates/widgets/{widget-id}.php` | Specific widget in any sidebar.
`templates/widgets/widget--default.php` | Any widget in any sidebar.


#### Widget Template Files

File | Description
---|---
`templates/widgets/widget--default.php` | The default HTML for widgets in this theme.


## SCSS

[CLI Reference](http://sass-lang.com/documentation/file.SASS_REFERENCE.html)

```
sass -scss --watch style.scss:style.css
```

