insert into fashion_categories (category_name) values
    ("Tops"),
    ("Bottoms"),
    ("Shoes"),
    ("Accessories");

insert into fashion_items (category_id, item_type, image_url, sex, size, price, stock) values
  (1, 'T-shirt', 'tshirt_image.jpg', 'Male', 'M', 19.99, 100),
  (1, 'Dress', 'dress_image.jpg', 'Female', 'L', 39.99, 50),
  (2, 'Jeans', 'jeans_image.jpg', 'Unisex', '32', 49.99, 75),
  (3, 'Sneakers', 'sneakers_image.jpg', 'Unisex', '7', 69.99, 120),
  (4, 'Necklace', 'necklace_image.jpg', 'Female', '', 29.99, 200);

insert into customers (name, address, city) values
  ('Your boy BOB', '123 Jurong Paradise', 'London'),
  ('Yijie the Fries King', '456 Brooklyn', 'New York');

insert into cart (customer_id, item_id, quantity, total_price, discount_price) values
  (1, 1, 2, 39.98, 35.98),
  (2, 3, 1, 49.99, 44.99),
  (3, 4, 2, 139.98, 129.98);