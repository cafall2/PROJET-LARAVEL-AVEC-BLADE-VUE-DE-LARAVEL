import { ShoppingCart } from 'lucide-react';
import { useCart } from '../contexts/CartContext';

interface Product {
  id: string;
  nom: string;
  description: string;
  prix: number;
  image_url: string;
  categorie: string;
  stock: number;
}

interface ProductCardProps {
  product: Product;
}

export default function ProductCard({ product }: ProductCardProps) {
  const { addToCart } = useCart();

  return (
    <div className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
      <div className="aspect-square overflow-hidden bg-gray-100">
        <img
          src={product.image_url}
          alt={product.nom}
          className="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
        />
      </div>
      <div className="p-4">
        <div className="flex justify-between items-start mb-2">
          <h3 className="text-lg font-semibold text-gray-900 line-clamp-1">{product.nom}</h3>
          <span className="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">
            {product.categorie}
          </span>
        </div>
        <p className="text-gray-600 text-sm mb-3 line-clamp-2">{product.description}</p>
        <div className="flex justify-between items-center">
          <span className="text-2xl font-bold text-gray-900">{product.prix.toLocaleString()} CFA</span>
          <button
            onClick={() => addToCart(product)}
            disabled={product.stock === 0}
            className={`flex items-center space-x-2 px-4 py-2 rounded-lg font-medium transition ${
              product.stock > 0
                ? 'bg-blue-600 hover:bg-blue-700 text-white'
                : 'bg-gray-300 text-gray-500 cursor-not-allowed'
            }`}
          >
            <ShoppingCart className="w-4 h-4" />
            <span>{product.stock > 0 ? 'Ajouter' : 'Rupture'}</span>
          </button>
        </div>
        {product.stock > 0 && product.stock <= 5 && (
          <p className="text-xs text-orange-600 mt-2">Plus que {product.stock} en stock</p>
        )}
      </div>
    </div>
  );
}
