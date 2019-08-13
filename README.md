# Wp_Posts_Contributors Plugin
A simple Posts contributor for WordPress Posts

## Plugin Documentation
1. Upload the **wp-posts-contributors** plugin directory to the /wp-content/plugins/ directory.
2. Activate **wp-posts-contributors** through the 'Plugins' menu in WordPress.
3. Add below code in your content template or inside of post loop.

```
<?php
if(class_exists('PostsContrubutors')){
	$obj= new PostsContrubutors;
	$obj->wp_posts_contributors_view(get_the_ID());
	}
?>
 ```
## Plugin Screenshots

**Back end**

![Screenshot_1](https://user-images.githubusercontent.com/6370697/61773626-f1c14700-ae16-11e9-85f0-f2c6624a4863.png)


**Front-end** 

![Screenshot_2](https://user-images.githubusercontent.com/6370697/61777204-61870000-ae1e-11e9-96a1-1f5779c5b273.png)

