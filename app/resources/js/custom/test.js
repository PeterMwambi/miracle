/*
|``````````````````````````````````````````````````````````````````````
|PROMISE TEST
|``````````````````````````````````````````````````````````````````````
 */

const promise = new Promise((resolve, reject) => {
  const num = Math.random();
  if (num >= 0.5) {
    resolve("Promise fulfilled");
  } else {
    reject("promise failed");
  }
});

function handleResolve(value) {
  console.log(value);
}

function handleReject(reason) {
  console.error(reason);
}

promise.then(handleResolve, handleReject);
