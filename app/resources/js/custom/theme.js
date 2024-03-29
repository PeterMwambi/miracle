/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Thu Oct 12 2023 23:21:31 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @abstract This script controls page theme functionality
 */

/*
`````````````````````````````````````````````````````````````````
DOM MANIPULATION
`````````````````````````````````````````````````````````````````
*/

/**
 * Gets an element specified by its id
 * @param {string} id
 * @returns HTMLElement
 */
function getElemById(id = string) {
  return document.getElementById(id);
}
/**
 * Get the body element
 * @returns HTMLElement
 */
function getBodyElem() {
  return document.body;
}

/*
``````````````````````````````````````````````````````````````````
FILE MANIPULATIONS
``````````````````````````````````````````````````````````````````
*/
/**
 * Lets web applications asynchronously read the contents of files
 * (or raw data buffers) stored on the user's computer,
 * using File or Blob objects to specify the file or data to read.
 * @param {object} input - the file to read
 * @param {object} output - display read results
 * @param {null} attribute - the trigger attribute
 * @returns void
 */
function readFile(input = object, output = object, attribute = null) {
  if (input) {
    reader = new FileReader();
    reader.onload = function () {
      output.setAttribute(getTriggeredAttr(attribute), reader.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

/**
 * Return the triggered attribute.
 * The trigger attribute is the attribute that changes
 * when an event is fired
 * trigger attributes are configured on readfile function
 * third argument.
 * @default "src"
 * @param {null} attribute - the triggered attribute
 * @returns string
 */
function getTriggeredAttr(attribute = null) {
  if (typeof attribute !== "string") {
    attribute = "src";
  }
  return attribute;
}

/**
 * Get the profile picture element by Id and
 * read uploaded file into profile preview on change
 */
function runProfileReaderSetup() {
  getElemById("dpz__profile-picture").addEventListener("change", function () {
    readFile(this, getElemById("dpz__profile-preview"));
  });
}

/*
``````````````````````````````````````````````````````````````````
THEME MANIPULATON
``````````````````````````````````````````````````````````````````
*/

const themeProperties = {
  /**
   * `````````````````````````````````````````````````````````````````
   * DEFAULT THEME PROPERTIES
   * `````````````````````````````````````````````````````````````````
   */

  /**
   * Theme switch element specified by Id
   * @param {string} themeSwitch
   */
  themeSwitch: "dpz__theme-switch",
  /**
   * Theme switch icon specified by id
   * @param {string}
   */
  themeSwitchIcon: "dpz__theme-switch-icon",
  /**
   * Dark theme identifier
   * @param {string}
   */
  themeDark: "dark",

  /**
   * Light theme identifier
   */
  themeLight: "light",

  /**
   * `````````````````````````````````````````````````````````````````
   * DARK THEME PROPERTIES
   * `````````````````````````````````````````````````````````````````
   */

  /**
   * Dark theme icon file path
   * @param {string}
   */
  darkThemeIcon: document
    .getElementById("dpz__theme-switch-icon")
    .getAttribute("data-dark-mode"),
  /**
   * Dark theme unwanted classes
   * @param {array}
   */
  darkThemeSearch: ["theme-light"],
  /**
   * Dark theme wanted classes
   * @param {string}
   */
  darkThemeReplace: "theme-dark",

  /**
   * `````````````````````````````````````````````````````````````````
   * LIGHT THEME PROPERTIES
   * `````````````````````````````````````````````````````````````````
   */

  /**
   * Light theme icon file path
   * @param {string}
   */
  lightThemeIcon: document
    .getElementById("dpz__theme-switch-icon")
    .getAttribute("data-light-mode"),
  /**
   * Light theme unwanted classes
   * @param {array}
   */
  lightThemeSearch: ["theme-dark"],
  /**
   * Light theme wanted classes
   * @param {string}
   */
  lightThemeReplace: "theme-light",
};

function themeSwitch() {
  return getElemById(themeProperties.themeSwitch);
}

function themeSwitchIcon() {
  return getElemById(themeProperties.themeSwitchIcon);
}

function themeToggler($search = [], $replace, $icon) {
  for ($x = 0; $x <= $search.length; $x++) {
    if (
      getBodyElem().classList.contains($search[$x]) ||
      getBodyElem().classList.length === 0
    ) {
      getBodyElem().classList.remove($search[$x]);
      getBodyElem().classList.add($replace);
      themeSwitchIcon().setAttribute("src", $icon);
    }
  }
}

function themeIconToggler($search, $replace) {
  themeSwitchIcon().classList.remove($search);
  themeSwitchIcon().classList.add($replace);
}

function setThemeToDark() {
  themeIconToggler(themeProperties.themeLight, themeProperties.themeDark);
  themeToggler(
    themeProperties.darkThemeSearch,
    themeProperties.darkThemeReplace,
    themeProperties.darkThemeIcon
  );
}

function setThemeToLight() {
  themeIconToggler(themeProperties.themeDark, themeProperties.themeLight);
  themeToggler(
    themeProperties.lightThemeSearch,
    themeProperties.lightThemeReplace,
    themeProperties.lightThemeIcon
  );
}

function addThemeToStorage($name, $theme, $oldTheme) {
  localStorage.removeItem($oldTheme);
  localStorage.setItem($name, $theme);
}

function setThemeFromStorage() {
  if (localStorage.getItem("dark")) {
    setThemeToDark();
  } else {
    if (localStorage.getItem("light")) {
      setThemeToLight();
    }
  }
}

function runThemeSetup() {
  setThemeByMedia();
  themeSwitch().addEventListener("click", function (e) {
    e.preventDefault();
    if (themeSwitchIcon().classList.contains(themeProperties.themeLight)) {
      addThemeToStorage(
        themeProperties.themeDark,
        themeProperties.darkThemeReplace,
        themeProperties.themeLight
      );
      setThemeToDark();
    } else {
      if (themeSwitchIcon().classList.contains(themeProperties.themeDark)) {
        addThemeToStorage(
          themeProperties.themeLight,
          themeProperties.lightThemeReplace,
          themeProperties.themeDark
        );
        setThemeToLight();
      }
    }
  });
  setThemeFromStorage();
}

function setThemeByMedia() {
  const dark = window.matchMedia("(prefers-color-scheme: dark)").matches;
  if (dark) {
    setThemeToDark();
  } else {
    setThemeToLight();
  }
}

runThemeSetup();
