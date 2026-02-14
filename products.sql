-- Create the products table
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image_url` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert some sample products
INSERT INTO `products` (`name`, `description`, `price`, `stock`, `image_url`, `status`) VALUES
('3D Printing Filament', 'High-quality filament made from recycled plastic. Perfect for sustainable 3D printing projects.', 29.99, 100, 'assets/images/products/filament.png', 'active'),
('Recycled Plastic Pellets', 'Premium recycled plastic pellets for manufacturing and creative uses. Eco-friendly and versatile.', 19.99, 150, 'assets/images/products/recycled-plastic.png', 'active'); 