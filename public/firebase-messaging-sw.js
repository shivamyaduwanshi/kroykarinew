/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyCi8b-EuP5ALXHO9s-IL9yEwbiwp3ZQ1Dk",
    authDomain: "buysell-3ff31.firebaseapp.com",
    databaseURL: "https://buysell-3ff31.firebaseio.com",
    projectId: "buysell-3ff31",
    storageBucket: "buysell-3ff31.appspot.com",
    messagingSenderId: "82314859613",
    appId: "1:82314859613:web:3ed59a791db5aa97bd29b4",
    measurementId: "G-7ZKCR0WFJK"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});