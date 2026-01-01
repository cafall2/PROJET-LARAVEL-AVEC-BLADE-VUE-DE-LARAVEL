import { useState } from 'react';
import { AuthProvider } from './contexts/AuthContext';
import { CartProvider } from './contexts/CartContext';
import Header from './components/Header';
import ProductList from './components/ProductList';
import AuthModal from './components/AuthModal';
import CartModal from './components/CartModal';
import CheckoutPage from './components/CheckoutPage';
import AdminDashboard from './components/AdminDashboard';

function App() {
  const [showAuth, setShowAuth] = useState(false);
  const [showCart, setShowCart] = useState(false);
  const [showCheckout, setShowCheckout] = useState(false);
  const [showAdmin, setShowAdmin] = useState(false);

  return (
    <AuthProvider>
      <CartProvider>
        <div className="min-h-screen bg-gray-50">
          {!showCheckout && !showAdmin && (
            <>
              <Header
                onShowCart={() => setShowCart(true)}
                onShowAuth={() => setShowAuth(true)}
                onShowAdmin={() => setShowAdmin(true)}
              />
              <ProductList />
            </>
          )}

          {showCheckout && (
            <CheckoutPage onBack={() => setShowCheckout(false)} />
          )}

          {showAdmin && (
            <AdminDashboard onBack={() => setShowAdmin(false)} />
          )}

          {showAuth && <AuthModal onClose={() => setShowAuth(false)} />}
          {showCart && (
            <CartModal
              onClose={() => setShowCart(false)}
              onCheckout={() => setShowCheckout(true)}
            />
          )}
        </div>
      </CartProvider>
    </AuthProvider>
  );
}

export default App;
