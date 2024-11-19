import React from 'react';
import { Facebook, Twitter, Instagram, Youtube } from 'lucide-react';

export default function Footer() {
  return (
    <footer className="bg-gray-900 text-white">
      <div className="max-w-7xl mx-auto px-4 py-16">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div>
            <h3 className="text-xl font-bold mb-4">STYLISH</h3>
            <p className="text-gray-400">Your destination for trendy and comfortable clothing.</p>
          </div>
          <div>
            <h4 className="font-semibold mb-4">Shop</h4>
            <ul className="space-y-2">
              <li><a href="/men" className="text-gray-400 hover:text-white">Men</a></li>
              <li><a href="/women" className="text-gray-400 hover:text-white">Women</a></li>
              <li><a href="/sale" className="text-gray-400 hover:text-white">Sale</a></li>
              <li><a href="/new" className="text-gray-400 hover:text-white">New Arrivals</a></li>
            </ul>
          </div>
          <div>
            <h4 className="font-semibold mb-4">Help</h4>
            <ul className="space-y-2">
              <li><a href="/faq" className="text-gray-400 hover:text-white">FAQ</a></li>
              <li><a href="/shipping" className="text-gray-400 hover:text-white">Shipping</a></li>
              <li><a href="/returns" className="text-gray-400 hover:text-white">Returns</a></li>
              <li><a href="/contact" className="text-gray-400 hover:text-white">Contact Us</a></li>
            </ul>
          </div>
          <div>
            <h4 className="font-semibold mb-4">Follow Us</h4>
            <div className="flex space-x-4">
              <a href="#" className="text-gray-400 hover:text-white">
                <Facebook className="h-6 w-6" />
              </a>
              <a href="#" className="text-gray-400 hover:text-white">
                <Twitter className="h-6 w-6" />
              </a>
              <a href="#" className="text-gray-400 hover:text-white">
                <Instagram className="h-6 w-6" />
              </a>
              <a href="#" className="text-gray-400 hover:text-white">
                <Youtube className="h-6 w-6" />
              </a>
            </div>
          </div>
        </div>
        <div className="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
          <p>&copy; 2024 STYLISH. All rights reserved.</p>
        </div>
      </div>
    </footer>
  );
}