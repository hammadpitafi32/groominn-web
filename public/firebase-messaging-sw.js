// Import and configure the Firebase SDK
importScripts('https://www.gstatic.com/firebasejs/9.0.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging-compat.js');

// Initialize the Firebase app in the service worker by passing the generated config
const firebaseConfig = {

  apiKey: 'AIzaSyCUsI12iXQR5KDnNSzY3DJaC5Offp26yG0',
  authDomain: 'groominn-8be33.firebaseapp.com',
  projectId: 'groominn-8be33',
  storageBucket: "groominn-8be33.appspot.com",
  messagingSenderId: '723791432433',
  appId: '1:723791432433:web:fb285dbb1d31707c93f750',
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

// Handle background messages
messaging.onBackgroundMessage((payload) => {
  console.log('Received background message: ', payload);
  
  // Customize notification details
  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
    icon: payload.notification.image, // Optional
  };

  self.registration.showNotification(notificationTitle, notificationOptions);
});
