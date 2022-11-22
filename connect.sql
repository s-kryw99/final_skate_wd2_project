

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








