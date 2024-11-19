import React from 'react';
import ProductCard from './ProductCard';

const products = [
  {
    id: 1,
    name: 'Classic White T-Shirt',
    price: 29.99,
    category: 'Men',
    image: 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
  },
  {
    id: 2,
    name: 'Denim Jacket',
    price: 89.99,
    category: 'Women',
    image: 'https://images.unsplash.com/photo-1544642899-f0d6e5f6ed6f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
  },
  {
    id: 3,
    name: 'Summer Dress',
    price: 59.99,
    category: 'Women',
    image: 'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
  },
  {
    id: 4,
    name: 'Slim Fit Jeans',
    price: 69.99,
    category: 'Men',
    image: 'https://images.unsplash.com/photo-1542272604-787c3835535d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
  },
];

export default function FeaturedProducts() {
  return (
    <div className="max-w-7xl mx-auto px-4 py-16">
      <h2 className="text-3xl font-bold text-gray-900 mb-8">Featured Products</h2>
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        {products.map((product) => (
          <ProductCard key={product.id} {...product} />
        ))}
      </div>
    </div>
  );
}