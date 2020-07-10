# DayByDay Installation

This implementation of the "Day by Day" website was created by the staff of the State Library of Ohio, using the code produced by the State Library of South Carolina. This implementation has been tested with [Drupal version 7.72](https://ftp.drupal.org/files/projects/drupal-7.72.tar.gz). The documentation below assumes that you have downloaded the file to the <code>/root/src</code> directory on the server where you're installing the software.

## Steps
The following steps are for a CentOS 7 server with PHP 7.3, MariaDB Server 5.5.65, and HTTPD installed, and assumes that the files in this repo have been placed at <code>/root/daybyday_org</code>.

```sh
service httpd start
service mariadb start
cd /root/daybyday_org
mysql -u root
           
   CREATE DATABASE daybyday_org CHARACTER SET utf8 COLLATE utf8_general_ci;
   CREATE USER 'daybydayuser'@'localhost' identified by 'Ch@ngeM3!';
   GRANT ALL PRIVILEGES ON daybyday_org.* to 'daybydayuser'@'localhost';
   USE daybyday_org;
   source daybyday.sql;
   quit;

cd /var/www/html
mv index.html index.html.old
tar zxf /root/src/drupal-7.72.tar.gz
mv drupal-7.72/* drupal-7.72/.* .
rmdir drupal-7.72
mv sites sites.old
cp -r /root/daybyday_org/sites .
cp /root/daybyday_org/redirect.php .
vi redirect.php        # update IP/hostname of server on line 7)
vi .htaccess           # add redirect.php as first entry of DirectoryIndex stanza
chown -R apache:apache .
```

Installation is now complete and you can begin customizing your site.


## Further Configuration
Out of the box, the system must be updated.


### Update the MySQL password
The password is set to <code>Ch@ngeM3!</code> for the MySQL username "daybydayuser".  You need to change this password in MySQL to something secure. The password also will need to be changed in the Drupal files.  Edit the <code>sites/default/settings.php</code> file and replace the <code>Ch@ngeM3!</code>password with your secure MySQL password.


### Update the Webmaster password
The password is set to <code>Ch@ngeM3!</code> for the Drupal administrative user. Log in with the username "Webmaster" at the login page:  http://your_server_name/user

"Webmaster" is the admin user with all permissions.  You'll see the Drupal Administration menus appear after you login as "Webmaster". Click on the "People" link (or go to http://your_server_name/admin/people) to see a list of Drupal users.  Click on the "edit" link for the "Webmaster" account to get to the page where you can change the account's password.


### Update the "Contact us!" form
In the Drupal Administration menus, go to --> Content --> Webforms (or go to http://your-server_name/admin/content/webform)

For the "Contact us!" line, click on "Components", then go to the "E-mails" "sub-tab" (http://your_server_name/node/514/webform/emails)

Edit or delete each record to point them at an email address that you'd like to use to receive your users' feedback.


### Update the "Contact us!" response
Edit the file <code>sites/all/themes/daybyday_theme/templates/webform-confirmation.tpl.php</code>

It currently contains redirects to www.somewhere.org. Update to match your local settings.

### Update the "Seek and Explore" content
This information needs to be localized.  Login as the user "Webmaster" and click on the "Seek and Explore" link in the top menubar to get to the page. The page is comprised of multiple components.

The "Explore Your State" area will have an "Edit" option if you are logged in as Webmaster.  Click on that link to edit that section of this page.

The "Places to Go & Things to Do" area will display a gear icon in the upper-left if you put the mouse pointer over the area while logged in as Webmaster.  To edit this content, click on the gear icon and then click on the "Configure Block" menu link that appears.

#### A note on the map
You can add a map of library locations in your state by following the [instructions here](https://support.google.com/mymaps/answer/3024454?hl=en&amp%3Bref_topic=3188329) and [here](https://www.google.com/earth/outreach/learn/visualize-your-data-on-a-custom-map-using-google-my-maps/#let-s-get-started-0).
You can optionally add the following script to center/zoom on the user's location.

```html
<script type="text/javascript">
// <![CDATA[
let x = document.getElementById("map");

function getLocation() {
    if (navigator.geolocation) {
        console.log('True');
        navigator.geolocation.getCurrentPosition(showPosition);
    }
}

function showPosition(position) {
    let base = "https://www.google.com/maps/d/embed?mid=1nSE_IzA0ddKz-rhqVCS9a4jg_fqwavA-";
    x.src = base + '&ll=' + position.coords.latitude + ',' + position.coords.longitude + '&z=10';
}

getLocation();
// ]]>
</script>
```

As a fallback, be sure that your emebedded map has default coordinates (the <code>&ll</code> parameter) and zoom level (the <code>&z</code> parameter)

### Update "Meet Ohio Authors" content
This information needs to be localized. Log in as "Webmaster" and navigate to to Read & Learn --> Meet Ohio Authors. Choose the "edit" option on this page to localize for your state.


### Optional
#### Change the text of entries in the top menu bar (e.g. "Get Creative", "Months", "Be Healthy")
This framework is controlled via a PHP file on the server:

<code>sites/all/themes/daybyday_theme/templates/region--navigation.tpl.php</code>

Edit this file to alter the top navigation bar.

#### Add your team!
Feel free to add your project team information to the “Collaborators and Support” section in the footer and the “Acknowledgements” section of the About page.

## FAQ
**Q:**  What's up with all of these hyperlinks that are commented out in the daily HTML metadata?

**A:**  We made some edits to original South Carolina implementation by dumping the MySQL database to file, performing regular expression transforms on the SQL data, and loading the transformed SQL as a new version of the database. At one point we considered hyperlinking the titles of books.  The South Carolina implementation had the titles hyperlinked to their local resources, so we couldn't continue to display those links.  Instead of removing the South Carolina title hyperlinks, I added HTML comments around the title hyperlinks to hide them, but I left the hyperlinks in place in case we decided to replace them in some automated fashion.  I'm leaving those commented links in the data you're getting.

An example is:

```html
<h3>Read a Book</h3>
<p>Here are two book recommendations for today. Check out the picture book collection at your local library, where there are lots of books to choose from! <a href=\"/places-in-oh\">Find nearby libraries.</a></p>
<ul>
   <li>
      <em>
         <!-- BTCO-SLO <a href=\"https://sclends.lib.sc.us/eg/opac/record/2651963?locg=1\"> --><strong>Latke, The Lucky Dog</strong> <!-- BTCO-SLO </a> -->
      </em>
      by Ellen Fischer; illustrations by Tiphanie Beeke<!-- BTCO-SLO <a href=\"https://sclends.lib.sc.us/eg/opac/record/881759?locg=1\"> --><strong></strong> <!-- BTCO-SLO </a> -->
   </li>
   <li>
      <em>
         <!-- BTCO-SLO <a href=\"https://sclends.lib.sc.us/eg/opac/record/2831214?locg=1\"> --><strong>Queen of the Hanukkah Dosas</strong> <!-- BTCO-SLO </a> -->
      </em>
      by Pamela Ehrenberg; illustrations by Anjan Sarkar
   </li>
</ul>
</div></div>
```
    
The HTML comments that I'm referring to include the text "BTCO-SLO".  So, a closing anchor tag (`</a>`) was commented out via `<!-- BTCO-SLO </a> -->`. At this point, this commented-out data serves no purpose other than to be a placeholder for possible future links.
