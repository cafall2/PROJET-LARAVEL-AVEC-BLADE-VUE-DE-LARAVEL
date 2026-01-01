import { useState } from 'react';
import { ArrowLeft, Smartphone, Wallet } from 'lucide-react';
import { useCart } from '../contexts/CartContext';
import { useAuth } from '../contexts/AuthContext';
import { api } from '../lib/api';

interface CheckoutPageProps {
  onBack: () => void;
}

export default function CheckoutPage({ onBack }: CheckoutPageProps) {
  const { cart, totalPrice, clearCart } = useCart();
  const { user } = useAuth();
  const [paymentMethod, setPaymentMethod] = useState<'orange_money' | 'wave' | null>(null);
  const [loading, setLoading] = useState(false);
  const [paymentStatus, setPaymentStatus] = useState<'idle' | 'processing' | 'success' | 'failed'>('idle');

  const handlePayment = async () => {
    if (!paymentMethod || !user) return;

    setLoading(true);
    setPaymentStatus('processing');

    try {
      const orderItems = cart.map(item => ({
        product_id: item.id,
        quantity: item.quantity,
        prix_unitaire: item.prix,
      }));

      await new Promise(resolve => setTimeout(resolve, 2000));

      const response = await api.orders.create(totalPrice, paymentMethod, orderItems);

      if (response.success && response.payment_success) {
        setPaymentStatus('success');
        clearCart();
      } else {
        setPaymentStatus('failed');
      }
    } catch (error) {
      console.error('Payment error:', error);
      setPaymentStatus('failed');
    } finally {
      setLoading(false);
    }
  };

  if (paymentStatus === 'success') {
    return (
      <div className="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <div className="bg-white rounded-lg shadow-lg p-8 max-w-md w-full text-center">
          <div className="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg className="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <h2 className="text-2xl font-bold text-gray-900 mb-2">Paiement réussi</h2>
          <p className="text-gray-600 mb-6">Votre commande a été confirmée avec succès.</p>
          <button
            onClick={onBack}
            className="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg transition"
          >
            Retour à la boutique
          </button>
        </div>
      </div>
    );
  }

  if (paymentStatus === 'failed') {
    return (
      <div className="min-h-screen bg-gray-50 flex items-center justify-center p-4">
        <div className="bg-white rounded-lg shadow-lg p-8 max-w-md w-full text-center">
          <div className="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg className="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
            </svg>
          </div>
          <h2 className="text-2xl font-bold text-gray-900 mb-2">Paiement échoué</h2>
          <p className="text-gray-600 mb-6">Une erreur est survenue lors du paiement. Veuillez réessayer.</p>
          <button
            onClick={() => setPaymentStatus('idle')}
            className="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg transition"
          >
            Réessayer
          </button>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-gray-50 py-8">
      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <button
          onClick={onBack}
          className="flex items-center space-x-2 text-gray-600 hover:text-gray-900 mb-6"
        >
          <ArrowLeft className="w-5 h-5" />
          <span>Retour</span>
        </button>

        <div className="bg-white rounded-lg shadow-md p-6 mb-6">
          <h2 className="text-2xl font-bold text-gray-900 mb-6">Récapitulatif de commande</h2>
          <div className="space-y-4 mb-6">
            {cart.map((item) => (
              <div key={item.id} className="flex justify-between items-center py-2 border-b">
                <div className="flex items-center gap-4">
                  <img src={item.image_url} alt={item.nom} className="w-16 h-16 object-cover rounded" />
                  <div>
                    <p className="font-medium text-gray-900">{item.nom}</p>
                    <p className="text-sm text-gray-600">Quantité: {item.quantity}</p>
                  </div>
                </div>
                <p className="font-semibold text-gray-900">
                  {(item.prix * item.quantity).toLocaleString()} CFA
                </p>
              </div>
            ))}
          </div>
          <div className="flex justify-between items-center pt-4 border-t">
            <span className="text-xl font-bold text-gray-900">Total</span>
            <span className="text-2xl font-bold text-gray-900">{totalPrice.toLocaleString()} CFA</span>
          </div>
        </div>

        <div className="bg-white rounded-lg shadow-md p-6">
          <h3 className="text-xl font-bold text-gray-900 mb-4">Mode de paiement</h3>
          <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <button
              onClick={() => setPaymentMethod('orange_money')}
              className={`p-6 border-2 rounded-lg transition ${
                paymentMethod === 'orange_money'
                  ? 'border-blue-600 bg-blue-50'
                  : 'border-gray-200 hover:border-gray-300'
              }`}
            >
              <Smartphone className="w-8 h-8 text-orange-600 mx-auto mb-2" />
              <p className="font-semibold text-gray-900">Orange Money</p>
            </button>
            <button
              onClick={() => setPaymentMethod('wave')}
              className={`p-6 border-2 rounded-lg transition ${
                paymentMethod === 'wave'
                  ? 'border-blue-600 bg-blue-50'
                  : 'border-gray-200 hover:border-gray-300'
              }`}
            >
              <Wallet className="w-8 h-8 text-blue-600 mx-auto mb-2" />
              <p className="font-semibold text-gray-900">Wave</p>
            </button>
          </div>

          <button
            onClick={handlePayment}
            disabled={!paymentMethod || loading}
            className="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed"
          >
            {loading ? 'Traitement en cours...' : 'Confirmer le paiement'}
          </button>
        </div>
      </div>
    </div>
  );
}
