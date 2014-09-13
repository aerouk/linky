# linky

A simple PHP URL shortener

## installation

* Drag all the files into a directory and add them to your Apache config. (If you're using nginx or some other type of server software, you'll have to convert the .htaccess file to work)
* Add all missing values to the **config.php** file in the **app/** directory.
* Create the **linky_urls** table in your MySQL server software. Use the following structure:  
  ![image](http://iaero.me/i/egXFB)  
  That's `id`, `url`, and `uri`.  
  Please ensure the **id** column is marked as the primary key and auto-increments.

## contributing

If you'd like to help with my project, just fork the project and create a pull request when you want your code merged. :)
