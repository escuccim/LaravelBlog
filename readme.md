# Simple Blog for Laravel

This is a simple skeleton blog application for Laravel.

It allows you to post, edit and delete blogs with tags and comments.

It also includes a homepage with a list of recent blog posts and an archives menu for the list of blog posts. These are stored in the cache to lighten DB load. I personally use Redis, but in the code I use Laravel's Cache facade, with the code to use Redis directly commented out.

## Install
To install just clone this, set up your .env file to point to a database, then run:
php artisan migrate
php artisan db:seed

This will create the following tables used in Laravel's built-in Auth:
  users
  password_resets
And add some fields to the users table if it already exists.
  
 And the following tables for blogs:
  blogs
  blogcomments
  blog_tag
  tags
  
The database will be seeded with one Admin use identified by 'admin@example.com' and 'password.' 
The database will also be seeded with a test label for the blogs called, appropriately, 'test', and an initial post tagged with label 'test.'

## How to Use
Once the database is seeded log in with the admin account and go to '/blog'. Admins will see a button to 'Add a Blog.' Clicking on the blog title will load a page with that blog post and comments. On this page Admins will see a link to Edit and Delete the blog. The rest should hopefully be self-explanatory. 

Note that on the main blog page Admins will see ALL blog posts, even those that are not yet published or are scheduled to be published at a future date. Posts which are not published with the 'publish' flag show up in yellow panels, posts which are not published because the publish_at date is in the future show up in red panels. 

Also note that when you view these pages as an admin the data is always pulled from the DB instead of being cached because the admin sees a different screen than normal users.

Lastly the users table contains a field for an image for each user. If the image exists it will be loaded next to their name when displaying their comments. Setting this image is beyond the scope of this package, but be aware it is there if you want to use it.

