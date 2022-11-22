

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
							

-fix upload image that resets for if done last





- Only admin / logged-in users can reach this form and create new pages.

-create non user non admin, dont sign in page path

-clicking brand will take you to a datbase of exiting brands to choose from. clicking the brand will show all entries by that band.

- fix decimal entry for width and height



++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

- cancel seesion autofills on registration page.

-fix warnings from sort button that disapear after pressing it.

-resize images on display

-fix sort so option stays

-registration should land on login page

-match basic styling accross all pages

-get select box options to stay after click when chosen.

























