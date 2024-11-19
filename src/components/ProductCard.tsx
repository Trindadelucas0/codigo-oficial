import React from 'react';
import { ShoppingCart } from 'lucide-react';

interface ProductCardProps {
  image: string;
  name: string;
  price: number;
  category: string;
}

export default function ProductCard({ image, name, price, category }: ProductCardProps) {
  return (
    <div className="group relative">
      <div className="aspect-square w-full overflow-hidden rounded-lg bg-gray-200">
        <img
          src={image}
          alt={name}
          className="h-full w-full object-cover object-center group-hover:opacity-75 transition-opacity"
        />
        <button className="absolute bottom-4 right-4 bg-white p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity">
          <ShoppingCart className="h-5 w-5 text-gray-900" />
        </button>
      </div>
      <div className="mt-4">
        <p className="text-sm text-gray-500">{category}</p>
        <h3 className="text-lg font-medium text-gray-900">{name}</h3>
        <p className="text-lg font-semibold text-gray-900">${price.toFixed(2)}</p>
      </div>
    </div>
  );
}