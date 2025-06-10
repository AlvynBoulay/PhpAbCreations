/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/scripts/base.js":
/*!********************************!*\
  !*** ./assets/scripts/base.js ***!
  \********************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _components_Menu_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./components/Menu.js */ \"./assets/scripts/components/Menu.js\");\n\nvar btnCloseMainNav = document.querySelector('.closeMainNav');\nbtnCloseMainNav.addEventListener('click', function () {\n  document.body.classList.remove('has-menu-opened');\n  document.body.classList.remove('no-scroll');\n});\nvar btnOpenMainNav = document.querySelector('.openMainNav');\nbtnOpenMainNav.addEventListener('click', function () {\n  document.body.classList.add('has-menu-opened');\n  document.body.classList.add('no-scroll');\n});\n\n// Bouton Revenir a la page précédente \nvar btnReturn = document.querySelector('.btnreturn .footerLink');\n\n// Ajout d'un événement \nif (btnReturn) {\n  btnReturn.addEventListener('click', function () {\n    window.history.back(); // Retourner à la page précédente\n  });\n}\n\n//# sourceURL=webpack://Afec_Starter_kit/./assets/scripts/base.js?");

/***/ }),

/***/ "./assets/scripts/components/Menu.js":
/*!*******************************************!*\
  !*** ./assets/scripts/components/Menu.js ***!
  \*******************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _data_navigation_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../data/navigation.js */ \"./assets/scripts/data/navigation.js\");\n\n\n/* <ul>\r\n<li><a href=\"index.html\" title=\"\" class=\"selected\">Accueil</a></li>\r\n<li><a href=\"portfolio.html\" title=\"\">Portfolio</a></li>\r\n<li><a href=\"a-propos.html\" title=\"\">A propos</a></li>\r\n<li><a href=\"contact.html\" title=\"\">Contact</a></li>\r\n<li><a href=\"profil.html\" title=\"\">Espace membre</a></li>\r\n</ul> */\nvar menuContainer = document.getElementById(\"menu\");\nvar pageSlug = document.body.dataset.page;\nvar menu = \"<ul>\";\nvar selectedClass = '';\n//  class=\"selected\"\n\n_data_navigation_js__WEBPACK_IMPORTED_MODULE_0__.links.forEach(function (link) {\n  if (pageSlug == link.id) {\n    selectedClass = \"class=\\\"selected\\\"\";\n  }\n  menu += \"<li><a href=\".concat(link.url, \" \").concat(selectedClass, \" title=\\\"\").concat(link.title, \"\\\">\").concat(link.title, \"</a></li>\");\n\n  // Réinitialisation de la classe\n  selectedClass = '';\n});\nmenu += \"</ul>\";\nmenuContainer.innerHTML = menu;\n\n//# sourceURL=webpack://Afec_Starter_kit/./assets/scripts/components/Menu.js?");

/***/ }),

/***/ "./assets/scripts/data/navigation.js":
/*!*******************************************!*\
  !*** ./assets/scripts/data/navigation.js ***!
  \*******************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   links: () => (/* binding */ links)\n/* harmony export */ });\nvar links = [{\n  title: 'Accueil',\n  url: 'index.html',\n  id: 'accueil'\n}, {\n  title: 'Portfolio',\n  url: 'portfolio.html',\n  id: 'portfolio'\n}, {\n  title: 'A propos',\n  url: 'a-propos.html',\n  id: 'a-propos'\n}, {\n  title: 'Contact',\n  url: 'contact.html',\n  id: 'contact'\n}, {\n  title: 'Espace membre',\n  url: 'profil.html',\n  id: 'espacemembre'\n}];\n\n//# sourceURL=webpack://Afec_Starter_kit/./assets/scripts/data/navigation.js?");

/***/ }),

/***/ "./assets/styles/base.scss":
/*!*********************************!*\
  !*** ./assets/styles/base.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// extracted by mini-css-extract-plugin\n\n\n//# sourceURL=webpack://Afec_Starter_kit/./assets/styles/base.scss?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	__webpack_require__("./assets/scripts/base.js");
/******/ 	var __webpack_exports__ = __webpack_require__("./assets/styles/base.scss");
/******/ 	
/******/ })()
;