SELECT product.id as id, product.name as name, product_categories.name as category 
FROM 
product INNER JOIN product_categories ON product.category_id = product_categories.id;
