
import { initializeApp } from 'firebase/app';
import { getMessaging } from 'firebase/messaging';

const firebaseConfig  = {
  apiKey: 'AIzaSyCUsI12iXQR5KDnNSzY3DJaC5Offp26yG0',
  authDomain: 'groominn-8be33.firebaseapp.com',
  projectId: 'groominn-8be33',
  messagingSenderId: '723791432433',
  appId: '1:723791432433:web:fb285dbb1d31707c93f750',
};

const app = initializeApp(firebaseConfig);
export const messaging = getMessaging(app);
