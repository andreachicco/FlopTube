/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/scripts/ts/close_alert.ts":
/*!***************************************!*\
  !*** ./src/scripts/ts/close_alert.ts ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _events__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./events */ \"./src/scripts/ts/events.ts\");\n\nwindow.addEventListener(_events__WEBPACK_IMPORTED_MODULE_0__.Events.LOAD, () => {\n    const closeAlertBtn = document.querySelector('.close-alert-btn');\n    const closeAlert = () => {\n        console.log('close alert');\n        const alertBox = document.querySelector('.alert-box');\n        if (alertBox)\n            alertBox.remove();\n    };\n    if (closeAlertBtn)\n        closeAlertBtn.addEventListener(_events__WEBPACK_IMPORTED_MODULE_0__.Events.CLICK, closeAlert);\n});\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvc2NyaXB0cy90cy9jbG9zZV9hbGVydC50cyIsIm1hcHBpbmdzIjoiOztBQUFrQztBQUVsQyxNQUFNLENBQUMsZ0JBQWdCLENBQUMsMkNBQU0sQ0FBQyxJQUFJLEVBQUUsR0FBRyxFQUFFO0lBQ3RDLE1BQU0sYUFBYSxHQUFHLFFBQVEsQ0FBQyxhQUFhLENBQUMsa0JBQWtCLENBQUMsQ0FBQztJQUVqRSxNQUFNLFVBQVUsR0FBRyxHQUFTLEVBQUU7UUFDMUIsT0FBTyxDQUFDLEdBQUcsQ0FBQyxhQUFhLENBQUMsQ0FBQztRQUMzQixNQUFNLFFBQVEsR0FBRyxRQUFRLENBQUMsYUFBYSxDQUFDLFlBQVksQ0FBQyxDQUFDO1FBQ3RELElBQUcsUUFBUTtZQUFFLFFBQVEsQ0FBQyxNQUFNLEVBQUUsQ0FBQztJQUNuQyxDQUFDO0lBRUQsSUFBRyxhQUFhO1FBQUUsYUFBYSxDQUFDLGdCQUFnQixDQUFDLDJDQUFNLENBQUMsS0FBSyxFQUFFLFVBQVUsQ0FBQyxDQUFDO0FBQy9FLENBQUMsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vZmxvcHR1YmUvLi9zcmMvc2NyaXB0cy90cy9jbG9zZV9hbGVydC50cz82ZTMxIl0sInNvdXJjZXNDb250ZW50IjpbImltcG9ydCB7IEV2ZW50cyB9IGZyb20gXCIuL2V2ZW50c1wiO1xyXG5cclxud2luZG93LmFkZEV2ZW50TGlzdGVuZXIoRXZlbnRzLkxPQUQsICgpID0+IHtcclxuICAgIGNvbnN0IGNsb3NlQWxlcnRCdG4gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuY2xvc2UtYWxlcnQtYnRuJyk7XHJcbiAgICBcclxuICAgIGNvbnN0IGNsb3NlQWxlcnQgPSAoKTogdm9pZCA9PiB7XHJcbiAgICAgICAgY29uc29sZS5sb2coJ2Nsb3NlIGFsZXJ0Jyk7XHJcbiAgICAgICAgY29uc3QgYWxlcnRCb3ggPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcuYWxlcnQtYm94Jyk7XHJcbiAgICAgICAgaWYoYWxlcnRCb3gpIGFsZXJ0Qm94LnJlbW92ZSgpO1xyXG4gICAgfVxyXG4gICAgXHJcbiAgICBpZihjbG9zZUFsZXJ0QnRuKSBjbG9zZUFsZXJ0QnRuLmFkZEV2ZW50TGlzdGVuZXIoRXZlbnRzLkNMSUNLLCBjbG9zZUFsZXJ0KTtcclxufSk7XHJcbiJdLCJuYW1lcyI6W10sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/scripts/ts/close_alert.ts\n");

/***/ }),

/***/ "./src/scripts/ts/events.ts":
/*!**********************************!*\
  !*** ./src/scripts/ts/events.ts ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   Events: () => (/* binding */ Events)\n/* harmony export */ });\nvar Events;\n(function (Events) {\n    Events[\"CLICK\"] = \"click\";\n    Events[\"LOAD\"] = \"load\";\n})(Events || (Events = {}));\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvc2NyaXB0cy90cy9ldmVudHMudHMiLCJtYXBwaW5ncyI6Ijs7OztBQUFBLElBQVksTUFHWDtBQUhELFdBQVksTUFBTTtJQUNkLHlCQUFlO0lBQ2YsdUJBQWE7QUFDakIsQ0FBQyxFQUhXLE1BQU0sS0FBTixNQUFNLFFBR2pCIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vZmxvcHR1YmUvLi9zcmMvc2NyaXB0cy90cy9ldmVudHMudHM/MzBlZCJdLCJzb3VyY2VzQ29udGVudCI6WyJleHBvcnQgZW51bSBFdmVudHMge1xyXG4gICAgQ0xJQ0sgPSAnY2xpY2snLFxyXG4gICAgTE9BRCA9ICdsb2FkJyxcclxufSJdLCJuYW1lcyI6W10sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/scripts/ts/events.ts\n");

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
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./src/scripts/ts/close_alert.ts");
/******/ 	
/******/ })()
;