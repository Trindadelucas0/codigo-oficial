import React from 'react';

export default function Hero() {
  return (
    <div className="relative h-[600px] bg-gray-900">
      <div 
        className="absolute inset-0 bg-cover bg-center"
        style={{
          backgroundImage: 'url("https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80")',
          opacity: '0.7'
        }}
      />
      <div className="relative max-w-7xl mx-auto px-4 h-full flex items-center">
        <div className="text-white max-w-xl">
          <h1 className="text-5xl font-bold mb-6">Summer Collection 2024</h1>
          <p className="text-xl mb-8">Discover our latest collection of trendy and comfortable clothing for every occasion.</p>
          <button className="bg-white text-gray-900 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors">
            Shop Now
          </button>
        </div>
      </div>
    </div>
  );
}