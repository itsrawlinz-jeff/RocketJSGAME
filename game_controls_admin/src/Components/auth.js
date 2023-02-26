// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
// import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyAD2Lh_5ZguOtuyghcwb9qKoS_uHn8H7Mg",
  authDomain: "horizon-b3c9e.firebaseapp.com",
  projectId: "horizon-b3c9e",
  storageBucket: "horizon-b3c9e.appspot.com",
  messagingSenderId: "336755058283",
  appId: "1:336755058283:web:1d139c74e3c9ceb35ff32e",
  measurementId: "G-4Q7XY7F4JX"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
// const analytics = getAnalytics(app);

export default app;