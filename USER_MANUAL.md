# Test the application on local server (offline):

**Pre-requisites**

* WAMP Server (Download link: https://sourceforge.net/projects/wampserver/)
* Any text editor (Default Notepad or *Notepad++*, *Sublime*, etc.)

**Setting up**

1. Download the ZIP file from repository
2. Extract and place the folder in `C:\wamp64\www`
3. Launch **Wampserver** application
4. Open your browser and type `localhost` in URL 
5. Navigate to **phpmyadmin** in the bottom-left corner
6. Login with username: *root*, no password and MySQL as server
7. Navigate to **Import** on the top menu bar and **Choose File:** Browse `C:\wamp64\www\hemi-main\user\db.sql` and Click **Go** 
8. Close your browser tabs

**User configuration**

9. Check the file `C:\wamp64\www\hemi-main\user\conn.php` using any text editor <br>
   Already configured with wamp defaults: ("*localhost*","*root*","","*hemi*",3306) <br>
   Note: You can also configure your preferred timezone in the same file ("*Continent*/*City*")

**Type the URL:** `localhost/hemi-main/index.php` **to start using your application** 

---

# Run the application as a private online messenger (online):

**Pre-requisites**

* Create an account on Infinity free hosting service (Link: https://infinityfree.net/)

**Setting up**

1. Create a hosting account with URL (domain name) of your choice. Open **Control Panel** when done.
2. Click **Online File Manager** and wait for it to load automatically
3. Upload all the files in the folder downloaded from repository by draggind and dropping into `/htdocs` folder
4. In the **Control Panel** click **MySQL Databases** to create a new database. 
5. Click **admin** to open your server
5. Navigate to **Import** on the top menu bar and **Choose File:** Browse your download folder for `hemi-main\user\db.sql` and Click **Go** <br>
   note: <i>open db.sql and remove/comment code for database creation to avoid error</i>
6. Close the tab after database is imported
7. On the **online file manager** open `/htdocs/user/conn.php`

**User configuration**

9. Configure your server with details provided in **MySQL Databases**: ("*hostname*","*username*","*password*","*database name*",3306) <br> 
   Note: the password is an auto-generated one. go back to hosting accounts page click **manage** and click **show/hide** to reveal it.<br>
   You can also configure your preferred timezone in the same file ("*Continent*/*City*")

**Your private messenger is live. You can use it from any mobile device and share the URL with any number of people to connect instantly**
