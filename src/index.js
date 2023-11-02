// import { initializeApp } from 'firebase/app';
// import {
//   getAuth,
//   connectAuthEmulator,
//   signInWithEmailAndPassword
// } from 'firebase/auth';

// // Initialize Firebase
// const firebaseApp = initializeApp({
//   apiKey: "AIzaSyBbiuAsUGmV2DCcxWeEC6JSCy-RuQB8TcQ",
//   authDomain: "ms-4afc3.firebaseapp.com",
//   projectId: "ms-4afc3",
//   storageBucket: "ms-4afc3.appspot.com",
//   messagingSenderId: "415927539778",
//   appId: "1:415927539778:web:39381dd654222b817075db"
// });

// // Login using email/password
// const loginEmailPassword = async () => {
//   const loginEmail = txtEmail.value
//   const loginPassword = txtPassword.value

//   // step 1: try doing this w/o error handling, and then add try/catch
//   await signInWithEmailAndPassword(auth, loginEmail, loginPassword)

//   // step 2: add error handling
//   try {
//     await signInWithEmailAndPassword(auth, loginEmail, loginPassword)
//   }
//   catch(error) {
//     console.log(`There was an error: ${error}`)
//     showLoginError(error)
//   }
// }

// // Create new account using email/password
// const createAccount = async () => {
//   const email = txtEmail.value
//   const password = txtPassword.value

//   try {
//     await createUserWithEmailAndPassword(auth, email, password)
//   }
//   catch(error) {
//     console.log(`There was an error: ${error}`)
//     showLoginError(error)
//   } 
// }

// // Monitor auth state
// const monitorAuthState = async () => {
//   onAuthStateChanged(auth, user => {
//     if (user) {
//       console.log(user)
//       showApp()
//       showLoginState(user)

//       hideLoginError()
//       hideLinkError()
//     }
//     else {
//       showLoginForm()
//       lblAuthState.innerHTML = `You're not logged in.`
//     }
//   })
// }

// // Log out
// const logout = async () => {
//   await signOut(auth);
// }

// btnLogin.addEventListener("click", loginEmailPassword) 
// btnSignup.addEventListener("click", createAccount)
// btnLogout.addEventListener("click", logout)

// const auth = getAuth(firebaseApp);
// connectAuthEmulator(auth, "http://localhost:5000");

// monitorAuthState();