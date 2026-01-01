import { X, Minus, Plus, Trash2 } from 'lucide-react';
import { useCart } from '../contexts/CartContext';

interface CartModalProps {
  onClose: () => void;
  onCheckout: () => void;
}

export default function CartModal({ onClose, onCheckout }: CartModalProps) {
  const { cart, removeFromCart, updateQuantity, totalPrice } = useCart();

  if (cart.length === 0) {
    return (
      <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div className="bg-white rounded-lg max-w-2xl w-full p-6 relative">
          <button
            onClick={onClose}
            className="absolute top-4 right-4 text-gray-400 hover:text-gray-600"
          >
            <X className="w-6 h-6" />
          </button>

          <h2 className="text-2xl font-bold text-gray-900 mb-6">Panier</h2>
          <div className="text-center py-12">
            <p className="text-gray-500 text-lg">Votre panier est vide</p>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div className="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-hidden flex flex-col relative">
        <div className="p-6 border-b">
          <button
            onClick={onClose}
            className="absolute top-4 right-4 text-gray-400 hover:text-gray-600"
          >
            <X className="w-6 h-6" />
          </button>
          <h2 className="text-2xl font-bold text-gray-900">Panier ({cart.length})</h2>
        </div>

        <div className="flex-1 overflow-y-auto p-6">
          <div className="space-y-4">
            {cart.map((item) => (
              <div key={item.id} className="flex gap-4 bg-gray-50 p-4 rounded-lg">
                <img
                  src={item.image_url}
                  alt={item.nom}
                  className="w-20 h-20 object-cover rounded"
                />
                <div className="flex-1">
                  <h3 className="font-semibold text-gray-900">{item.nom}</h3>
                  <p className="text-gray-600 font-medium">{item.prix.toLocaleString()} CFA</p>
                  <div className="flex items-center gap-2 mt-2">
                    <button
                      onClick={() => updateQuantity(item.id, item.quantity - 1)}
                      className="p-1 rounded hover:bg-gray-200 transition"
                    >
                      <Minus className="w-4 h-4" />
                    </button>
                    <span className="w-8 text-center font-medium">{item.quantity}</span>
                    <button
                      onClick={() => updateQuantity(item.id, item.quantity + 1)}
                      className="p-1 rounded hover:bg-gray-200 transition"
                    >
                      <Plus className="w-4 h-4" />
                    </button>
                    <button
                      onClick={() => removeFromCart(item.id)}
                      className="ml-auto p-1 text-red-600 hover:bg-red-50 rounded transition"
                    >
                      <Trash2 className="w-4 h-4" />
                    </button>
                  </div>
                </div>
                <div className="text-right">
                  <p className="font-bold text-gray-900">
                    {(item.prix * item.quantity).toLocaleString()} CFA
                  </p>
                </div>
              </div>
            ))}
          </div>
        </div>

        <div className="border-t p-6 bg-gray-50">
          <div className="flex justify-between items-center mb-4">
            <span className="text-lg font-semibold text-gray-900">Total</span>
            <span className="text-2xl font-bold text-gray-900">
              {totalPrice.toLocaleString()} CFA
            </span>
          </div>
          <button
            onClick={() => {
              onClose();
              onCheckout();
            }}
            className="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg transition"
          >
            Passer la commande
          </button>
        </div>
      </div>
    </div>
  );
}
