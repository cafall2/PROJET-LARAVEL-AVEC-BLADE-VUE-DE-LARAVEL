import { ShoppingCart, User, LogOut, LayoutDashboard } from 'lucide-react';
import { useAuth } from '../contexts/AuthContext';
import { useCart } from '../contexts/CartContext';

interface HeaderProps {
  onShowCart: () => void;
  onShowAuth: () => void;
  onShowAdmin: () => void;
}

export default function Header({ onShowCart, onShowAuth, onShowAdmin }: HeaderProps) {
  const { user, signOut, isAdmin } = useAuth();
  const { totalItems } = useCart();

  return (
    <header className="bg-white shadow-md sticky top-0 z-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-16">
          <div className="flex items-center">
            <h1 className="text-2xl font-bold text-gray-900">ShopSénégal</h1>
          </div>

          <nav className="flex items-center space-x-4">
            {user && isAdmin && (
              <button
                onClick={onShowAdmin}
                className="flex items-center space-x-2 text-gray-700 hover:text-gray-900 transition"
              >
                <LayoutDashboard className="w-5 h-5" />
                <span className="hidden sm:inline">Admin</span>
              </button>
            )}

            <button
              onClick={onShowCart}
              className="flex items-center space-x-2 text-gray-700 hover:text-gray-900 transition relative"
            >
              <ShoppingCart className="w-6 h-6" />
              {totalItems > 0 && (
                <span className="absolute -top-2 -right-2 bg-blue-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                  {totalItems}
                </span>
              )}
            </button>

            {user ? (
              <button
                onClick={() => signOut()}
                className="flex items-center space-x-2 text-gray-700 hover:text-gray-900 transition"
              >
                <LogOut className="w-5 h-5" />
                <span className="hidden sm:inline">Déconnexion</span>
              </button>
            ) : (
              <button
                onClick={onShowAuth}
                className="flex items-center space-x-2 text-gray-700 hover:text-gray-900 transition"
              >
                <User className="w-5 h-5" />
                <span className="hidden sm:inline">Connexion</span>
              </button>
            )}
          </nav>
        </div>
      </div>
    </header>
  );
}
