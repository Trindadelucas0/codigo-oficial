import React from 'react';
import { ShoppingCart, User, Search, Menu } from 'lucide-react';
import { useState } from 'react';

export default function Navbar() {
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  return (
    <nav className="bg-white shadow-md fixed w-full z-50">
      <div className="max-w-7xl mx-auto px-4">
        <div className="flex justify-between items-center h-16">
          {/* Logo */}
          <div className="flex-shrink-0 flex items-center">
            <h1 className="text-2xl font-bold text-gray-800">STYLISH</h1>
          </div>

          {/* Desktop Navigation */}
          <div className="hidden md:flex items-center space-x-8">
            <a href="/" className="text-gray-600 hover:text-gray-900">Home</a>
            <a href="/men" className="text-gray-600 hover:text-gray-900">Men</a>
            <a href="/women" className="text-gray-600 hover:text-gray-900">Women</a>
            <a href="/sale" className="text-gray-600 hover:text-gray-900">Sale</a>
          </div>

          {/* Search Bar */}
          <div className="hidden md:flex items-center flex-1 max-w-md mx-8">
            <div className="relative w-full">
              <input
                type="text"
                placeholder="Search for products..."
                className="w-full px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:border-gray-500"
              />
              <Search className="absolute right-3 top-2.5 h-5 w-5 text-gray-400" />
            </div>
          </div>

          {/* Icons */}
          <div className="flex items-center space-x-4">
            <button className="text-gray-600 hover:text-gray-900">
              <User className="h-6 w-6" />
            </button>
            <button className="text-gray-600 hover:text-gray-900 relative">
              <ShoppingCart className="h-6 w-6" />
              <span className="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center">
                0
              </span>
            </button>
            <button 
              className="md:hidden text-gray-600 hover:text-gray-900"
              onClick={() => setIsMenuOpen(!isMenuOpen)}
            >
              <Menu className="h-6 w-6" />
            </button>
          </div>
        </div>

        {/* Mobile Menu */}
        {isMenuOpen && (
          <div className="md:hidden py-4">
            <div className="flex flex-col space-y-4">
              <a href="/" className="text-gray-600 hover:text-gray-900">Home</a>
              <a href="/men" className="text-gray-600 hover:text-gray-900">Men</a>
              <a href="/women" className="text-gray-600 hover:text-gray-900">Women</a>
              <a href="/sale" className="text-gray-600 hover:text-gray-900">Sale</a>
              <div className="relative">
                <input
                  type="text"
                  placeholder="Search for products..."
                  className="w-full px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:border-gray-500"
                />
                <Search className="absolute right-3 top-2.5 h-5 w-5 text-gray-400" />
              </div>
            </div>
          </div>
        )}
      </div>
    </nav>
  );
}