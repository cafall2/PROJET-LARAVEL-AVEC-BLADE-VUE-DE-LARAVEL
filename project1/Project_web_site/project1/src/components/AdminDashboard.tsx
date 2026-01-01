import { useState, useEffect } from 'react';
import { ArrowLeft, Plus, CreditCard as Edit2, Trash2, Package } from 'lucide-react';
import { api, Product, Order } from '../lib/api';

interface AdminDashboardProps {
  onBack: () => void;
}

export default function AdminDashboard({ onBack }: AdminDashboardProps) {
  const [activeTab, setActiveTab] = useState<'products' | 'orders'>('products');
  const [products, setProducts] = useState<Product[]>([]);
  const [orders, setOrders] = useState<Order[]>([]);
  const [showProductForm, setShowProductForm] = useState(false);
  const [editingProduct, setEditingProduct] = useState<Product | null>(null);
  const [loading, setLoading] = useState(false);

  const [formData, setFormData] = useState({
    nom: '',
    description: '',
    prix: '',
    image_url: '',
    categorie: '',
    stock: '',
  });

  useEffect(() => {
    fetchProducts();
    fetchOrders();
  }, []);

  const fetchProducts = async () => {
    try {
      const response = await api.products.getAll();
      if (response.success && response.data) {
        setProducts(response.data);
      }
    } catch (error) {
      console.error('Error fetching products:', error);
    }
  };

  const fetchOrders = async () => {
    try {
      const response = await api.orders.getAll();
      if (response.success && response.data) {
        setOrders(response.data);
      }
    } catch (error) {
      console.error('Error fetching orders:', error);
    }
  };

  const handleSubmitProduct = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);

    try {
      const productData = {
        nom: formData.nom,
        description: formData.description,
        prix: parseFloat(formData.prix),
        image_url: formData.image_url,
        categorie: formData.categorie,
        stock: parseInt(formData.stock),
      };

      if (editingProduct) {
        await api.products.update({ ...productData, id: editingProduct.id, created_at: editingProduct.created_at });
      } else {
        await api.products.create(productData);
      }

      setFormData({ nom: '', description: '', prix: '', image_url: '', categorie: '', stock: '' });
      setEditingProduct(null);
      setShowProductForm(false);
      fetchProducts();
    } catch (error) {
      console.error('Error saving product:', error);
    } finally {
      setLoading(false);
    }
  };

  const handleDeleteProduct = async (id: string) => {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) {
      try {
        await api.products.delete(id);
        fetchProducts();
      } catch (error) {
        console.error('Error deleting product:', error);
      }
    }
  };

  const handleEditProduct = (product: Product) => {
    setEditingProduct(product);
    setFormData({
      nom: product.nom,
      description: product.description,
      prix: product.prix.toString(),
      image_url: product.image_url,
      categorie: product.categorie,
      stock: product.stock.toString(),
    });
    setShowProductForm(true);
  };

  const handleUpdateOrderStatus = async (orderId: string, newStatus: string) => {
    try {
      await api.orders.updateStatus(orderId, newStatus);
      fetchOrders();
    } catch (error) {
      console.error('Error updating order status:', error);
    }
  };

  return (
    <div className="min-h-screen bg-gray-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <button
          onClick={onBack}
          className="flex items-center space-x-2 text-gray-600 hover:text-gray-900 mb-6"
        >
          <ArrowLeft className="w-5 h-5" />
          <span>Retour</span>
        </button>

        <h1 className="text-3xl font-bold text-gray-900 mb-6">Tableau de bord Admin</h1>

        <div className="flex space-x-2 mb-6">
          <button
            onClick={() => setActiveTab('products')}
            className={`px-4 py-2 rounded-lg font-medium transition ${
              activeTab === 'products'
                ? 'bg-blue-600 text-white'
                : 'bg-white text-gray-700 hover:bg-gray-100'
            }`}
          >
            Produits
          </button>
          <button
            onClick={() => setActiveTab('orders')}
            className={`px-4 py-2 rounded-lg font-medium transition ${
              activeTab === 'orders'
                ? 'bg-blue-600 text-white'
                : 'bg-white text-gray-700 hover:bg-gray-100'
            }`}
          >
            Commandes
          </button>
        </div>

        {activeTab === 'products' && (
          <div>
            <div className="flex justify-between items-center mb-6">
              <h2 className="text-xl font-semibold text-gray-900">Gestion des produits</h2>
              <button
                onClick={() => {
                  setShowProductForm(true);
                  setEditingProduct(null);
                  setFormData({ nom: '', description: '', prix: '', image_url: '', categorie: '', stock: '' });
                }}
                className="flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition"
              >
                <Plus className="w-5 h-5" />
                <span>Ajouter un produit</span>
              </button>
            </div>

            {showProductForm && (
              <div className="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 className="text-lg font-semibold text-gray-900 mb-4">
                  {editingProduct ? 'Modifier le produit' : 'Nouveau produit'}
                </h3>
                <form onSubmit={handleSubmitProduct} className="space-y-4">
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input
                      type="text"
                      placeholder="Nom du produit"
                      value={formData.nom}
                      onChange={(e) => setFormData({ ...formData, nom: e.target.value })}
                      className="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                      required
                    />
                    <input
                      type="number"
                      placeholder="Prix (CFA)"
                      value={formData.prix}
                      onChange={(e) => setFormData({ ...formData, prix: e.target.value })}
                      className="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                      required
                    />
                    <input
                      type="text"
                      placeholder="Catégorie"
                      value={formData.categorie}
                      onChange={(e) => setFormData({ ...formData, categorie: e.target.value })}
                      className="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                      required
                    />
                    <input
                      type="number"
                      placeholder="Stock"
                      value={formData.stock}
                      onChange={(e) => setFormData({ ...formData, stock: e.target.value })}
                      className="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                      required
                    />
                  </div>
                  <input
                    type="url"
                    placeholder="URL de l'image"
                    value={formData.image_url}
                    onChange={(e) => setFormData({ ...formData, image_url: e.target.value })}
                    className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    required
                  />
                  <textarea
                    placeholder="Description"
                    value={formData.description}
                    onChange={(e) => setFormData({ ...formData, description: e.target.value })}
                    className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    rows={3}
                    required
                  />
                  <div className="flex space-x-2">
                    <button
                      type="submit"
                      disabled={loading}
                      className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition disabled:opacity-50"
                    >
                      {loading ? 'Enregistrement...' : 'Enregistrer'}
                    </button>
                    <button
                      type="button"
                      onClick={() => {
                        setShowProductForm(false);
                        setEditingProduct(null);
                      }}
                      className="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg transition"
                    >
                      Annuler
                    </button>
                  </div>
                </form>
              </div>
            )}

            <div className="bg-white rounded-lg shadow-md overflow-hidden">
              <table className="min-w-full divide-y divide-gray-200">
                <thead className="bg-gray-50">
                  <tr>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix</th>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Catégorie</th>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                  </tr>
                </thead>
                <tbody className="bg-white divide-y divide-gray-200">
                  {products.map((product) => (
                    <tr key={product.id}>
                      <td className="px-6 py-4">
                        <div className="flex items-center">
                          <img src={product.image_url} alt={product.nom} className="w-12 h-12 object-cover rounded" />
                          <span className="ml-3 font-medium text-gray-900">{product.nom}</span>
                        </div>
                      </td>
                      <td className="px-6 py-4 text-gray-900">{product.prix.toLocaleString()} CFA</td>
                      <td className="px-6 py-4 text-gray-600">{product.categorie}</td>
                      <td className="px-6 py-4 text-gray-900">{product.stock}</td>
                      <td className="px-6 py-4">
                        <div className="flex space-x-2">
                          <button
                            onClick={() => handleEditProduct(product)}
                            className="text-blue-600 hover:text-blue-800"
                          >
                            <Edit2 className="w-5 h-5" />
                          </button>
                          <button
                            onClick={() => handleDeleteProduct(product.id)}
                            className="text-red-600 hover:text-red-800"
                          >
                            <Trash2 className="w-5 h-5" />
                          </button>
                        </div>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        )}

        {activeTab === 'orders' && (
          <div>
            <h2 className="text-xl font-semibold text-gray-900 mb-6">Gestion des commandes</h2>
            <div className="bg-white rounded-lg shadow-md overflow-hidden">
              <table className="min-w-full divide-y divide-gray-200">
                <thead className="bg-gray-50">
                  <tr>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paiement</th>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                  </tr>
                </thead>
                <tbody className="bg-white divide-y divide-gray-200">
                  {orders.map((order) => (
                    <tr key={order.id}>
                      <td className="px-6 py-4 text-gray-900">{order.user_nom || 'N/A'}</td>
                      <td className="px-6 py-4 text-gray-900 font-medium">{order.total.toLocaleString()} CFA</td>
                      <td className="px-6 py-4">
                        <span className="text-sm text-gray-600">{order.payment_method}</span>
                      </td>
                      <td className="px-6 py-4">
                        <select
                          value={order.statut}
                          onChange={(e) => handleUpdateOrderStatus(order.id, e.target.value)}
                          className="text-sm border border-gray-300 rounded px-2 py-1"
                        >
                          <option value="pending">En attente</option>
                          <option value="paid">Payé</option>
                          <option value="shipped">Expédié</option>
                          <option value="delivered">Livré</option>
                          <option value="cancelled">Annulé</option>
                        </select>
                      </td>
                      <td className="px-6 py-4 text-gray-600 text-sm">
                        {new Date(order.created_at).toLocaleDateString('fr-FR')}
                      </td>
                      <td className="px-6 py-4">
                        <Package className="w-5 h-5 text-gray-400" />
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        )}
      </div>
    </div>
  );
}
