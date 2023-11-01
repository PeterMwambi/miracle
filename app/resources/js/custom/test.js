"use strict";

const root = document.querySelector(".root");

let counter = 0;

let timeOn = 0;

function startCounter() {
  root.innerHTML = counter;
  counter++;
  setTimeout(startCounter, 1000);
}

function playCounter() {
  if (!timeOn) {
    timeOn = 1;
    startCounter();
  }
}

// playCounter();

/**
 * Using the date class to create a custom timer
 */
function playTime() {
  const date = new Date();
  root.innerHTML = date.toLocaleTimeString();
  setTimeout(playTime, 1000);
}

playTime();

/**
 * Creating a custom dom tree creation tool
 */
function createElement(elem) {
  return document.createElement(elem);
}

const header = document.createElement("header");

header.appendChild(createElement("div"));

// console.log(header.childNodes);

// root.appendChild(header);

// root.after.createElement("button");

const sliderContainer = document.querySelector(".slider-container");

const sliderItem = document.querySelectorAll(".slider-item");

let sliderInterval;

// function playSlider() {
//   sliderItem.classList.add("slider-item-active");
//   sliderInterval = setTimeout(playSlider, 5000);
// }

function classListAdd(item, className) {
  return item.classList.add(className);
}

function classListHas(item, className) {
  return item.classList.contains(className);
}

function classListRemove(item, className) {
  return item.classList.remove(className);
}

// playSlider();

for (let i = 0; i < sliderItem.length; i++) {
  setTimeout;
  classListAdd(sliderItem[i], "slider-item-active");
}

// function
