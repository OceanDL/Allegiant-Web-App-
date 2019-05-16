# code-challenge

All challenges were completed outside of a in-progress customer profile view

Pictures of the layout can be found in the img folder

# Instructions

There are three main components of this project, the rest API, loading of the .csv customer files to the mysql db, and the dashboard interface.(NOTE: DB settings will need altered for demonstration, all setup was done on a local XAMPP server)

Here are the endpoints that you will utilize for this project with a brief description:

http://localhost/code-challenge/js/dashboard

View of the dashboard with customer information, can search and view customer rows.

http://localhost/code-challenge/etl/loadData.php

This file is used to load the .csv customer files to associated customers sql table.

http://localhost/code-challenge/ws/customers[ID or LastName]

As a GET request this endpoint can be accessed with no parameters to get all customer records, an ID to get a specific customer record, or a last name as a query. 

As a POST request you may insert a new customer as a JSON object. 

As a PUT request you may modify a pre-existing customer by providing the JSON object and ID in the request. 

As a DELETE request you may use an id as a parameter to delete the associated customer record from the table.






