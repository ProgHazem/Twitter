-- this project like as small twitter
-- I used mvc with php and using Ubuntu
to use this project you should change in file apache2/sites-available/000-default.con
and write this change:
                    <Directory /var/www/html/Twitter>
                        Options Indexes FollowSymLinks
                        AllowOverride All
                        Require all granted
                    </Directory>
and also change in file app/config/config.php
    configure database and root path
   
-- import file twitter to phpmyadmin 

-- in phpmyadmin should remove from sql mode variable   "ONLY_FULL_GROUP_BY"

-- All files and Folder should have permissions 

...............................................................................................

                                        Describe of project
In app folder:          
contains 5 models (Comment, Follower, Reply, Tweet, User);
contains 5 controllers(Comments, Replies, Tweetes, Users, Pages)
contains 4 views and each views contains files That's file will apeare to users
contains libraries that contains 3 files Core, Controller, Database
    Core is used to read url and divide it
    Controller is used to load views and models
    Database is used to load function that helps you in sql operations
file bootstrap used to load files that you will use
In public folder:
contains js, css, images and index file.


there is folder that contains screenshoots

 