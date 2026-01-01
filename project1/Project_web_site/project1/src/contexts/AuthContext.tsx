import { createContext, useContext, useEffect, useState, ReactNode } from 'react';
import { api, User } from '../lib/api';

interface AuthContextType {
  user: User | null;
  loading: boolean;
  signUp: (email: string, password: string, nom: string, telephone: string) => Promise<{ error: string | null }>;
  signIn: (email: string, password: string) => Promise<{ error: string | null }>;
  signOut: () => Promise<void>;
  isAdmin: boolean;
}

const AuthContext = createContext<AuthContextType | undefined>(undefined);

export function AuthProvider({ children }: { children: ReactNode }) {
  const [user, setUser] = useState<User | null>(null);
  const [loading, setLoading] = useState(true);
  const [isAdmin, setIsAdmin] = useState(false);

  useEffect(() => {
    checkSession();
  }, []);

  const checkSession = async () => {
    try {
      const response = await api.auth.getSession();
      if (response.success && response.user) {
        setUser(response.user);
        setIsAdmin(response.user.is_admin || false);
      }
    } catch (error) {
      console.error('Session check error:', error);
    } finally {
      setLoading(false);
    }
  };

  const signUp = async (email: string, password: string, nom: string, telephone: string) => {
    try {
      const response = await api.auth.register(nom, email, password, telephone);
      if (response.success) {
        setUser(response.user);
        setIsAdmin(response.user.is_admin || false);
        return { error: null };
      }
      return { error: response.message || 'Erreur lors de l\'inscription' };
    } catch (error: any) {
      return { error: error.message || 'Erreur réseau' };
    }
  };

  const signIn = async (email: string, password: string) => {
    try {
      const response = await api.auth.login(email, password);
      if (response.success) {
        setUser(response.user);
        setIsAdmin(response.user.is_admin || false);
        return { error: null };
      }
      return { error: response.message || 'Erreur lors de la connexion' };
    } catch (error: any) {
      return { error: error.message || 'Erreur réseau' };
    }
  };

  const signOut = async () => {
    try {
      await api.auth.logout();
      setUser(null);
      setIsAdmin(false);
    } catch (error) {
      console.error('Logout error:', error);
    }
  };

  return (
    <AuthContext.Provider value={{ user, loading, signUp, signIn, signOut, isAdmin }}>
      {children}
    </AuthContext.Provider>
  );
}

export function useAuth() {
  const context = useContext(AuthContext);
  if (context === undefined) {
    throw new Error('useAuth must be used within an AuthProvider');
  }
  return context;
}
