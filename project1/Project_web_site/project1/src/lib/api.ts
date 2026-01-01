const API_BASE_URL = 'http://localhost/php/api';

export interface User {
  id: string;
  nom: string;
  email: string;
  telephone?: string;
  is_admin: boolean;
}

export interface Product {
  id: string;
  nom: string;
  description: string;
  prix: number;
  image_url: string;
  categorie: string;
  stock: number;
  created_at: string;
}

export interface Order {
  id: string;
  user_id: string;
  total: number;
  statut: 'pending' | 'paid' | 'shipped' | 'delivered' | 'cancelled';
  payment_method: 'orange_money' | 'wave';
  payment_status: 'pending' | 'success' | 'failed';
  created_at: string;
  user_nom?: string;
}

export const api = {
  auth: {
    register: async (nom: string, email: string, password: string, telephone: string) => {
      const response = await fetch(`${API_BASE_URL}/auth.php?action=register`, {
        method: 'POST',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ nom, email, password, telephone }),
      });
      return response.json();
    },

    login: async (email: string, password: string) => {
      const response = await fetch(`${API_BASE_URL}/auth.php?action=login`, {
        method: 'POST',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email, password }),
      });
      return response.json();
    },

    logout: async () => {
      const response = await fetch(`${API_BASE_URL}/auth.php?action=logout`, {
        method: 'POST',
        credentials: 'include',
      });
      return response.json();
    },

    getSession: async () => {
      const response = await fetch(`${API_BASE_URL}/auth.php`, {
        method: 'GET',
        credentials: 'include',
      });
      return response.json();
    },
  },

  products: {
    getAll: async (): Promise<{ success: boolean; data: Product[] }> => {
      const response = await fetch(`${API_BASE_URL}/products.php`, {
        credentials: 'include',
      });
      return response.json();
    },

    create: async (product: Omit<Product, 'id' | 'created_at'>) => {
      const response = await fetch(`${API_BASE_URL}/products.php`, {
        method: 'POST',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(product),
      });
      return response.json();
    },

    update: async (product: Product) => {
      const response = await fetch(`${API_BASE_URL}/products.php`, {
        method: 'PUT',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(product),
      });
      return response.json();
    },

    delete: async (id: string) => {
      const response = await fetch(`${API_BASE_URL}/products.php?id=${id}`, {
        method: 'DELETE',
        credentials: 'include',
      });
      return response.json();
    },
  },

  orders: {
    getAll: async (): Promise<{ success: boolean; data: Order[] }> => {
      const response = await fetch(`${API_BASE_URL}/orders.php`, {
        credentials: 'include',
      });
      return response.json();
    },

    create: async (total: number, payment_method: string, items: any[]) => {
      const response = await fetch(`${API_BASE_URL}/orders.php`, {
        method: 'POST',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ total, payment_method, items }),
      });
      return response.json();
    },

    updateStatus: async (id: string, statut: string) => {
      const response = await fetch(`${API_BASE_URL}/orders.php`, {
        method: 'PUT',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id, statut }),
      });
      return response.json();
    },
  },
};
