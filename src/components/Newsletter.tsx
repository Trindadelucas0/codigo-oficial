import React from 'react';
import { Mail } from 'lucide-react';

export default function Newsletter() {
  return (
    <div className="bg-gray-100">
      <div className="max-w-7xl mx-auto px-4 py-16">
        <div className="text-center">
          <Mail className="h-12 w-12 mx-auto text-gray-900 mb-4" />
          <h2 className="text-3xl font-bold text-gray-900 mb-4">Subscribe to our newsletter</h2>
          <p className="text-gray-600 mb-8">Get the latest updates on new products and upcoming sales</p>
          <div className="max-w-md mx-auto">
            <div className="flex gap-4">
              <input
                type="email"
                placeholder="Enter your email"
                className="flex-1 px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:border-gray-500"
              />
              <button className="bg-gray-900 text-white px-8 py-3 rounded-full font-semibold hover:bg-gray-800 transition-colors">
                Subscribe
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}