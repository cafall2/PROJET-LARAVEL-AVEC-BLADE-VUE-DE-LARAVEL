import { createClient } from '@supabase/supabase-js';

const supabaseUrl = import.meta.env.VITE_SUPABASE_URL;
const supabaseAnonKey = import.meta.env.VITE_SUPABASE_ANON_KEY;

export const supabase = createClient(supabaseUrl, supabaseAnonKey);

export type Database = {
  public: {
    Tables: {
      profiles: {
        Row: {
          id: string;
          nom: string;
          telephone: string | null;
          is_admin: boolean;
          created_at: string;
        };
        Insert: {
          id: string;
          nom: string;
          telephone?: string | null;
          is_admin?: boolean;
          created_at?: string;
        };
        Update: {
          id?: string;
          nom?: string;
          telephone?: string | null;
          is_admin?: boolean;
          created_at?: string;
        };
      };
      products: {
        Row: {
          id: string;
          nom: string;
          description: string;
          prix: number;
          image_url: string;
          categorie: string;
          stock: number;
          created_at: string;
        };
        Insert: {
          id?: string;
          nom: string;
          description: string;
          prix: number;
          image_url: string;
          categorie: string;
          stock?: number;
          created_at?: string;
        };
        Update: {
          id?: string;
          nom?: string;
          description?: string;
          prix?: number;
          image_url?: string;
          categorie?: string;
          stock?: number;
          created_at?: string;
        };
      };
      orders: {
        Row: {
          id: string;
          user_id: string;
          total: number;
          statut: 'pending' | 'paid' | 'shipped' | 'delivered' | 'cancelled';
          payment_method: 'orange_money' | 'wave' | null;
          payment_status: 'pending' | 'success' | 'failed';
          created_at: string;
        };
        Insert: {
          id?: string;
          user_id: string;
          total: number;
          statut?: 'pending' | 'paid' | 'shipped' | 'delivered' | 'cancelled';
          payment_method?: 'orange_money' | 'wave' | null;
          payment_status?: 'pending' | 'success' | 'failed';
          created_at?: string;
        };
        Update: {
          id?: string;
          user_id?: string;
          total?: number;
          statut?: 'pending' | 'paid' | 'shipped' | 'delivered' | 'cancelled';
          payment_method?: 'orange_money' | 'wave' | null;
          payment_status?: 'pending' | 'success' | 'failed';
          created_at?: string;
        };
      };
      order_items: {
        Row: {
          id: string;
          order_id: string;
          product_id: string;
          quantity: number;
          prix_unitaire: number;
          created_at: string;
        };
        Insert: {
          id?: string;
          order_id: string;
          product_id: string;
          quantity: number;
          prix_unitaire: number;
          created_at?: string;
        };
        Update: {
          id?: string;
          order_id?: string;
          product_id?: string;
          quantity?: number;
          prix_unitaire?: number;
          created_at?: string;
        };
      };
    };
  };
};
