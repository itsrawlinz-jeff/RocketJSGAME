const express = require('express');
const admin = require('firebase-admin');

const cors = require('cors');
const app = express();
app.use(cors());

// Initialize Firebase Admin SDK
const serviceAccount = require('./horizon-firebase-adminsdk.json');
admin.initializeApp({
  credential: admin.credential.cert(serviceAccount)
});
const db = admin.firestore();
// commenting on details

// Store the current odds counter value
const animationsRef = db.collection('animations').doc('animation');

// Store the current odds counter value
let oddsCounter = 0;
let isPlaying = false;

// Endpoint to retrieve the current odds counter value
app.get('/oddscounter', (req, res) => {
  res.send(oddsCounter.toString());
});

// Endpoint to increment the odds counter value
app.post('/incrementoddscounter', (req, res) => {
  var interval;
  
  function startInterval() {
    interval = setInterval(() => {
      if (isPlaying) {
        oddsCounter += 0.01;
        // if oddsCounter reaches 100, reset it to 0
        if (oddsCounter >= 100) {
          oddsCounter = 0;
        }
      } else {
        clearInterval(interval);
        // then set oddsCounter to 0 immediately after clearing the interval
        oddsCounter = 0;
      }
      console.log(oddsCounter);
    }, 100);
  }

  startInterval();

  // Stop the interval if isPlaying is set to false
  animationsRef.onSnapshot((doc) => {
    if (doc.exists) {
      const data = doc.data();
      isPlaying = data.isPlaying;
      if (!isPlaying) {
        clearInterval(interval);
      } else {
        oddsCounter = 0; // reset oddsCounter to 0 when isPlaying becomes true
        setTimeout(() => {
          startInterval();
        }, 5000);
      }
    }
  });

  res.sendStatus(200);
});


// Start the server
app.listen(8080, () => {
  console.log('Server listening on port 8080');
});
