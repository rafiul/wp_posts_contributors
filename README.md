# Wp_Posts_Contributors
A simple Posts contributor for WordPress Posts

## Plugin Documentation
1. Upload the **rt-contributors** plugin directory to the /wp-content/plugins/ directory.
2. Activate **rt-contributors** through the 'Plugins' menu in WordPress.
3. Add below code in your content template or inside of post loop.

```
<?php 
	if(function_exists('rt_contributors')){
		rt_contributors(get_the_ID());
	}
?>
 ```
## Plugin Screenshots

**Back end**

![Screenshot_1](https://user-images.githubusercontent.com/6370697/61773626-f1c14700-ae16-11e9-85f0-f2c6624a4863.png)


**Front-end** 

![Screenshot_2](https://user-images.githubusercontent.com/6370697/61777204-61870000-ae1e-11e9-96a1-1f5779c5b273.png)

