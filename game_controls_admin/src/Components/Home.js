import React from 'react'
import './home.css'
// import { initializeApp } from 'firebase/app';
import { getFirestore, updateDoc, doc } from 'firebase/firestore/lite'; // collection, getDocs,
import app from './auth';


export default function Home() {

  const db = getFirestore(app);

  // const getCollection = async () => {
  //   const citiesCol = collection(db, 'animations');
  //   const citySnapshot = await getDocs(citiesCol);
  //   const cityList = citySnapshot.docs.map(doc => doc.data());
  //   console.log( "city", cityList);
  // }

  const startAnimation = async() => {
    updateDoc(doc(db, "animations", "animation"), {
      isPlaying: true
    });

    console.log("start animation");
  }

  const stopAnimation = async() => {
    updateDoc(doc(db, "animations", "animation"), {
      isPlaying: false
    });

    console.log("stop animation");

    // set 5 seconds delay before starting animation again
    setTimeout(() => {
      startAnimation();
    }
    , 5000);


  }



  return (
    <div>
      <h1>Horizon start and stop animation</h1>
      <button onClick={startAnimation}>Start</button>
      <button onClick={stopAnimation}>Stop</button>
      {/* <button onClick={getCollection}>Get Collection</button> */}

    </div>
  )
}
