

INSERT INTO customer (first_name, last_name)
VALUES ('Brad','Vincelette');


SELECT cust_id, first_name, last_name, MD5(CONCAT(first_name,last_name)) AS user_pass , active
FROM customer;


SELECT user_id, user_name, user_admin
FROM users
WHERE user_email='bvincelette@rrc.ca' AND user_pass=$_POST['user_pass'] AND active=1;
	

SELECT user_id, user_name,
	user_admin
FROM users
WHERE user_email


UPDATE customer
SET active=1
WHERE cust_id=5;

SELECT * from movie;

-- mysql
-- localhost
-- 3306
-- don't specify database
-- root
-- blank password



KEY STRINGS AND WORDS AND NOTES::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

<!-- html header starts here -->




TODO:

-fix warnings from sort button that disapear after pressing it.

-Password matching and verify

-fix sort

-resize images on display

-fix upload image that resets for if done last

-get select box options to stay after click when chosen.

-match basc styling accross all pages

-  fix login confirm (it stoped showing)

-registration should land on login page

- cancel seesion autofills on registration page.

- Only admin / logged-in users can reach this form and create new pages.

-create non user non admin, dont sign in page path

-clicking brand will take you to a datbase of exiting brands to choose from. clicking the brand will show all entries by that band.

- fix decimal entry for width and height
- The security could be as simple as using the provided auth script from the blog assignment, or more complex as defined below.
- Admin users must have the ability to view all registered users, add users, update users, and delete users.



<?php
if (isset($_POST[$cata])) {
     return $_POST[$cata];
 } else {
     return;
 }
 ?>


171.0
System provides the ability to process, record, and track collections.

Automate this to:
keep upto date with what has been collected and what needs to be. 

when these things are done togeather they wil produce the most accurate records

if these things are done seperatly it can create gaps in when each is completed, 



System provides the ability to bill by type of customer.  

(56)

