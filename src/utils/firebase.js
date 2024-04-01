// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: process.env.FIREBASE,
  authDomain: "encryptopia-dev.firebaseapp.com",
  projectId: "encryptopia-dev",
  storageBucket: "encryptopia-dev.appspot.com",
  messagingSenderId: "721421852300",
  appId: "1:721421852300:web:fb21aa4488dad96aa525a9",
  measurementId: "G-N8ER1XWPMV"
};

// Initialize Firebase
export const app = initializeApp(firebaseConfig);