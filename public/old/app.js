import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.6.0/firebase-app.js'
import { getAuth,createUserWithEmailAndPassword, signInWithEmailAndPassword, onAuthStateChanged, signOut } from 'https://www.gstatic.com/firebasejs/10.6.0/firebase-auth.js'
import { getFirestore, collection, getDocs } from 'https://www.gstatic.com/firebasejs/10.6.0/firebase-firestore.js'

const firebaseConfig = {
    apiKey: "AIzaSyBbiuAsUGmV2DCcxWeEC6JSCy-RuQB8TcQ",
    authDomain: "ms-4afc3.firebaseapp.com",
    databaseURL: "https://ms-4afc3-default-rtdb.firebaseio.com",
    projectId: "ms-4afc3",
    storageBucket: "ms-4afc3.appspot.com",
    messagingSenderId: "415927539778",
    appId: "1:415927539778:web:39381dd654222b817075db"
  };

const app = initializeApp(firebaseConfig);

const auth = getAuth(app);
const db = getFirestore();

const userEmail = document.querySelector("#userEmail");
const userPassword = document.querySelector("#userPassword");
const userState = document.querySelector("#userState");
const authForm = document.querySelector("#authForm");
const whenSignedIn = document.querySelector("#whenSignedIn");
const signUpButton = document.querySelector("#signUpButton");
const signInButton = document.querySelector("#signInButton");
const signOutButton = document.querySelector("#signOutButton");
const colRef = collection(db, 'userInfo')

// get collection data
getDocs(colRef)
  .then(snapshot => {
    // console.log(snapshot.docs)
    let userInfo = []
    snapshot.docs.forEach(doc => {
        userInfo.push({ ...doc.data(), id: doc.id })
    })
    console.log(userInfo)
  })
  .catch(err => {
    console.log(err.message)
  })

whenSignedIn.style.display = 'none';

const userSignUp = async() => {
    const signUpEmail = userEmail.value;
    const signUpPassword = userPassword.value;
    createUserWithEmailAndPassword(auth, signUpEmail, signUpPassword)
    .then((userCredential) => {
        const user = userCredential.user;
        console.log(user);
        return db.collection('users').doc(cred.user.uid).set({
            state: signUpButton['signup-state'].value
        });

        alert("Your account has been created!");
    })
    .catch((error) => {
        const errorCode = error.code;
        const errorMessage = error.message;
        console.log(errorCode + errorMessage)
    })
}

const userSignIn = async() => {
    const signInEmail = userEmail.value;
    const signInPassword = userPassword.value;
    signInWithEmailAndPassword(auth, signInEmail, signInPassword)
    .then((userCredential) => {
        const user = userCredential.user;
        // redirect to profile.html
        window.location.href = 'profile.html';



    })
    .catch((error) => {
        const errorCode = error.code;
        const errorMessage = error.message;
        console.log(errorCode + errorMessage)
    })
}

const checkAuthState = async() => {
    onAuthStateChanged(auth, user => {
        if(user) {
            authForm.style.display = 'none';
            whenSignedIn.style.display = 'block';
            // redirect to profile.html
            window.location.href = 'profile.html';
        }
        else {
            authForm.style.display = 'block';
            whenSignedIn.style.display = 'none';
        }
    })
}

const userSignOut = async() => {
    await signOut(auth);
}

checkAuthState();

signUpButton.addEventListener('click', userSignUp);
signInButton.addEventListener('click', userSignIn);
signOutButton.addEventListener('click', userSignOut);