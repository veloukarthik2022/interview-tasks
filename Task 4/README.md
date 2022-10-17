<p>First install the composer packages.</p>

<code>Composer install | Composer update</code>

<p>After install npm modules &  run this command npm run dev & npm run watch</p>

<h4>Setup environmental  file, run this command "copy .env.dist .env</h4>
<p>Configure the database and its crdentials</p>

<h4>Migrate the tables using "php artisan migrate"</h4>
<p>To run the application, enter this command on terminal "php artisan serve"</p>
 

 Market Place API Documentation

Store Seller Lots
Endpoint: http://0.0.0.0:8000/api/v1/lots/
Method: Post

Request:
{
"company":"Delicious Apples LTD",
"lot_name":"Red Dacca",
"product_name":"Apples",
"weight":500,
"minimum_weight":1000,
"country":"Costa Rica",
"harvest_date":"2018-07-27",
"status":"bidding"
}

Response:
{
    "status": "success",
"message": "Your lot is saved successfully"
“data” : 
{
“lot_id”:1,
"company":"Delicious Apples LTD",
"lot_name":"Red Dacca",
"product_name":"Apples",
"weight":500,
"minimum_weight":1000,
"country":"Costa Rica",
"harvest_date":"2018-07-27",
"status":"bidding"
}
}
















Update Seller Lots
Endpoint: http://0.0.0.0:8000/api/v1/lots/1
Method: Put
Request:
{
"harvest_date":"2018-06-14",
}

Response:
{
    "status": "success",
"message": "Your lot is updated successfully"
“data” : 
{
“lot_id”:1,
"company":"Delicious Apples LTD",
"lot_name":"Red Dacca",
"product_name":"Apples",
"weight":500,
"minimum_weight":1000,
"country":"Costa Rica",
"harvest_date":"2018-06-14",
"status":"bidding"
}

}
