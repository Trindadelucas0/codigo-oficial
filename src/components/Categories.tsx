import React from 'react';

const categories = [
  {
    name: 'Men',
    image: 'https://images.unsplash.com/photo-1490578474895-699cd4e2cf59?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
  },
  {
    name: 'Women',
    image: 'https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
  },
];

export default function Categories() {
  return (
    <div className="max-w-7xl mx-auto px-4 py-16">
      <h2 className="text-3xl font-bold text-gray-900 mb-8">Shop by Category</h2>
      <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
        {categories.map((category) => (
          <div key={category.name} className="relative h-96 group cursor-pointer">
            <div className="absolute inset-0">
              <img
                src={category.image}
                alt={category.name}
                className="h-full w-full object-cover rounded-lg"
              />
              <div className="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-50 transition-all rounded-lg" />
            </div>
            <div className="relative h-full flex items-center justify-center">
              <div className="text-center">
                <h3 className="text-3xl font-bold text-white mb-4">{category.name}</h3>
                <button className="bg-white text-gray-900 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors">
                  Shop Now
                </button>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}