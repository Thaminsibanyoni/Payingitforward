import axios from 'axios';

const api = axios.create({
  baseURL: process.env.REACT_APP_API_URL,
  withCredentials: true
});

// Add request interceptor to include auth token
api.interceptors.request.use(config => {
  const token = localStorage.getItem('authToken');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

// Unified error handling for API responses
api.interceptors.response.use(
  response => response,
  error => {
    const status = error.response?.status;
    const serverMessage = error.response?.data?.message;
    
    // User-friendly messages based on status code
    const messageMap = {
      400: 'Invalid request format',
      401: 'Please login to continue',
      403: 'You don\'t have permission for this action',
      404: 'Resource not found',
      409: 'Conflict detected',
      500: 'Server error - please try again later'
    };
    
    const message = serverMessage || messageMap[status] || 'An unexpected error occurred';

    // Handle unauthorized access
    if (status === 401) {
      localStorage.removeItem('authToken');
      window.location = '/login';
    }

    console.error(`API Error [${status}]: ${message}`);
    
    return Promise.reject({
      code: status,
      message,
      details: error.response?.data
    });
  }
);

// Authentication
export const login = async (credentials) => {
  const response = await api.post('/login', credentials);
  localStorage.setItem('authToken', response.data.token);
  return response.data;
};

export const register = async (userData) => {
  const response = await api.post('/register', userData);
  localStorage.setItem('authToken', response.data.token);
  return response.data;
};

// User Profile
export const getCurrentUser = async () => api.get('/user');
export const updateProfile = async (data) => api.put('/user', data);
export const submitKyc = async (documents) => api.post('/user/kyc', documents);
export const getTransactions = async () => api.get('/user/transactions');

// Notifications
export const getNotifications = async () => api.get('/notifications');
export const markNotificationRead = async (id) => api.put(`/notifications/${id}/read`);

// Payments
export const initiateDeposit = async (data) => api.post('/payments/deposit', data);
export const initiateWithdrawal = async (data) => api.post('/payments/withdraw', data);
export const getPaymentGateways = async () => api.get('/payments/gateways');

// Acts
export const getActs = async () => api.get('/acts');
export const createAct = async (actData) => api.post('/acts', actData);
export const completeAct = async (actId) => api.post(`/acts/${actId}/complete`);
export const payForwardAct = async (actId) => api.post(`/acts/${actId}/pay-forward`);

// Blockchain
export const registerOnChain = async () => api.post('/blockchain/register');
export const logActOnChain = async (actId) => api.post(`/blockchain/log-act/${actId}`);
export const getTokenBalance = async (address) => api.get(`/blockchain/balance/${address}`);
