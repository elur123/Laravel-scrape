## Laravel scrape - assessment

Task Description: Develop a command to scrape all available products listed on https://sugargang.com/collections/alle-produkte and display them on a webpage. Collect the following product information:

Product Title
Price
Quantity (number of products available)
Product Image
Product Ingredients
SKU

On your webpage, please include the following features:

A paginated list of products
The ability to search for a specific product by Product Title or SKU
The ability to view a product page with all the gathered information
On the product page view, include an "EDIT" button that appears when the user hovers their mouse over the Product Title. Upon clicking the button, allow the user to modify the product ingredients, quantity, and product title. Automatically save any changes to the database.
Display a bar chart with the following data:
X-axis: Product Title
Y-axis: Quantity
Ensure the product page is mobile-friendly.

Technical Requirements: Please use Laravel, MongoDB, and VueJS for this task.

### Project Tech stack

1. PHP v8
2. Laravel v9
3. Node v18.15
4. Vue v3
5. Inertia 
6. Chartjs
7. MongoDB

### Project Steps

1. composer install
2. update file (config/database), change mongodb DB_URI.
3. php artisan migrate
4. npm install
5. npm run dev
