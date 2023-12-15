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

/***/ "./src/scripts/ts/events.ts":
/*!**********************************!*\
  !*** ./src/scripts/ts/events.ts ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   Events: () => (/* binding */ Events)\n/* harmony export */ });\nvar Events;\n(function (Events) {\n    Events[\"CLICK\"] = \"click\";\n})(Events || (Events = {}));\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvc2NyaXB0cy90cy9ldmVudHMudHMiLCJtYXBwaW5ncyI6Ijs7OztBQUFBLElBQVksTUFFWDtBQUZELFdBQVksTUFBTTtJQUNkLHlCQUFlO0FBQ25CLENBQUMsRUFGVyxNQUFNLEtBQU4sTUFBTSxRQUVqQiIsInNvdXJjZXMiOlsid2VicGFjazovL2Zsb3B0dWJlLy4vc3JjL3NjcmlwdHMvdHMvZXZlbnRzLnRzPzMwZWQiXSwic291cmNlc0NvbnRlbnQiOlsiZXhwb3J0IGVudW0gRXZlbnRzIHtcclxuICAgIENMSUNLID0gJ2NsaWNrJyxcclxufSJdLCJuYW1lcyI6W10sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./src/scripts/ts/events.ts\n");

/***/ }),

/***/ "./src/scripts/ts/menu-animation.ts":
/*!******************************************!*\
  !*** ./src/scripts/ts/menu-animation.ts ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _events__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./events */ \"./src/scripts/ts/events.ts\");\n\nconst burgerMenu = document.querySelector('.burger');\nconst menuAnimation = () => {\n    const menu = document.querySelector('.links');\n    const burgerLines = document.querySelectorAll('.line');\n    if (menu === null || menu === void 0 ? void 0 : menu.classList.contains('animate-menu-slide-in')) {\n        burgerLines[0].classList.remove('animate-top-line-active');\n        burgerLines[2].classList.remove('animate-bottom-line-active');\n        menu === null || menu === void 0 ? void 0 : menu.classList.remove('animate-menu-slide-in');\n        menu === null || menu === void 0 ? void 0 : menu.classList.add('animate-menu-slide-out');\n    }\n    else {\n        burgerLines[0].classList.add('animate-top-line-active');\n        burgerLines[2].classList.add('animate-bottom-line-active');\n        menu === null || menu === void 0 ? void 0 : menu.classList.remove('animate-menu-slide-out');\n        menu === null || menu === void 0 ? void 0 : menu.classList.add('animate-menu-slide-in');\n    }\n    burgerLines[1].classList.toggle('invisible');\n};\nif (burgerMenu)\n    burgerMenu.addEventListener(_events__WEBPACK_IMPORTED_MODULE_0__.Events.CLICK, menuAnimation);\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9zcmMvc2NyaXB0cy90cy9tZW51LWFuaW1hdGlvbi50cyIsIm1hcHBpbmdzIjoiOztBQUFrQztBQUVsQyxNQUFNLFVBQVUsR0FBbUIsUUFBUSxDQUFDLGFBQWEsQ0FBQyxTQUFTLENBQUMsQ0FBQztBQUVyRSxNQUFNLGFBQWEsR0FBRyxHQUFTLEVBQUU7SUFDN0IsTUFBTSxJQUFJLEdBQW1CLFFBQVEsQ0FBQyxhQUFhLENBQUMsUUFBUSxDQUFDLENBQUM7SUFDOUQsTUFBTSxXQUFXLEdBQXdCLFFBQVEsQ0FBQyxnQkFBZ0IsQ0FBQyxPQUFPLENBQUMsQ0FBQztJQUU1RSxJQUFHLElBQUksYUFBSixJQUFJLHVCQUFKLElBQUksQ0FBRSxTQUFTLENBQUMsUUFBUSxDQUFDLHVCQUF1QixDQUFDLEVBQUUsQ0FBQztRQUNuRCxXQUFXLENBQUMsQ0FBQyxDQUFDLENBQUMsU0FBUyxDQUFDLE1BQU0sQ0FBQyx5QkFBeUIsQ0FBQyxDQUFDO1FBQzNELFdBQVcsQ0FBQyxDQUFDLENBQUMsQ0FBQyxTQUFTLENBQUMsTUFBTSxDQUFDLDRCQUE0QixDQUFDLENBQUM7UUFDOUQsSUFBSSxhQUFKLElBQUksdUJBQUosSUFBSSxDQUFFLFNBQVMsQ0FBQyxNQUFNLENBQUMsdUJBQXVCLENBQUMsQ0FBQztRQUNoRCxJQUFJLGFBQUosSUFBSSx1QkFBSixJQUFJLENBQUUsU0FBUyxDQUFDLEdBQUcsQ0FBQyx3QkFBd0IsQ0FBQyxDQUFDO0lBQ2xELENBQUM7U0FDSSxDQUFDO1FBQ0YsV0FBVyxDQUFDLENBQUMsQ0FBQyxDQUFDLFNBQVMsQ0FBQyxHQUFHLENBQUMseUJBQXlCLENBQUMsQ0FBQztRQUN4RCxXQUFXLENBQUMsQ0FBQyxDQUFDLENBQUMsU0FBUyxDQUFDLEdBQUcsQ0FBQyw0QkFBNEIsQ0FBQyxDQUFDO1FBQzNELElBQUksYUFBSixJQUFJLHVCQUFKLElBQUksQ0FBRSxTQUFTLENBQUMsTUFBTSxDQUFDLHdCQUF3QixDQUFDLENBQUM7UUFDakQsSUFBSSxhQUFKLElBQUksdUJBQUosSUFBSSxDQUFFLFNBQVMsQ0FBQyxHQUFHLENBQUMsdUJBQXVCLENBQUMsQ0FBQztJQUNqRCxDQUFDO0lBRUQsV0FBVyxDQUFDLENBQUMsQ0FBQyxDQUFDLFNBQVMsQ0FBQyxNQUFNLENBQUMsV0FBVyxDQUFDLENBQUM7QUFDakQsQ0FBQztBQUVELElBQUcsVUFBVTtJQUFFLFVBQVUsQ0FBQyxnQkFBZ0IsQ0FBQywyQ0FBTSxDQUFDLEtBQUssRUFBRSxhQUFhLENBQUMsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovL2Zsb3B0dWJlLy4vc3JjL3NjcmlwdHMvdHMvbWVudS1hbmltYXRpb24udHM/ZWVjNyJdLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgeyBFdmVudHMgfSBmcm9tIFwiLi9ldmVudHNcIjtcclxuXHJcbmNvbnN0IGJ1cmdlck1lbnU6IEVsZW1lbnQgfCBudWxsID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLmJ1cmdlcicpO1xyXG5cclxuY29uc3QgbWVudUFuaW1hdGlvbiA9ICgpOiB2b2lkID0+IHtcclxuICAgIGNvbnN0IG1lbnU6IEVsZW1lbnQgfCBudWxsID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLmxpbmtzJyk7XHJcbiAgICBjb25zdCBidXJnZXJMaW5lczogTm9kZUxpc3RPZjxFbGVtZW50PiA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy5saW5lJyk7XHJcblxyXG4gICAgaWYobWVudT8uY2xhc3NMaXN0LmNvbnRhaW5zKCdhbmltYXRlLW1lbnUtc2xpZGUtaW4nKSkge1xyXG4gICAgICAgIGJ1cmdlckxpbmVzWzBdLmNsYXNzTGlzdC5yZW1vdmUoJ2FuaW1hdGUtdG9wLWxpbmUtYWN0aXZlJyk7XHJcbiAgICAgICAgYnVyZ2VyTGluZXNbMl0uY2xhc3NMaXN0LnJlbW92ZSgnYW5pbWF0ZS1ib3R0b20tbGluZS1hY3RpdmUnKTtcclxuICAgICAgICBtZW51Py5jbGFzc0xpc3QucmVtb3ZlKCdhbmltYXRlLW1lbnUtc2xpZGUtaW4nKTtcclxuICAgICAgICBtZW51Py5jbGFzc0xpc3QuYWRkKCdhbmltYXRlLW1lbnUtc2xpZGUtb3V0Jyk7XHJcbiAgICB9XHJcbiAgICBlbHNlIHtcclxuICAgICAgICBidXJnZXJMaW5lc1swXS5jbGFzc0xpc3QuYWRkKCdhbmltYXRlLXRvcC1saW5lLWFjdGl2ZScpO1xyXG4gICAgICAgIGJ1cmdlckxpbmVzWzJdLmNsYXNzTGlzdC5hZGQoJ2FuaW1hdGUtYm90dG9tLWxpbmUtYWN0aXZlJyk7XHJcbiAgICAgICAgbWVudT8uY2xhc3NMaXN0LnJlbW92ZSgnYW5pbWF0ZS1tZW51LXNsaWRlLW91dCcpO1xyXG4gICAgICAgIG1lbnU/LmNsYXNzTGlzdC5hZGQoJ2FuaW1hdGUtbWVudS1zbGlkZS1pbicpO1xyXG4gICAgfVxyXG5cclxuICAgIGJ1cmdlckxpbmVzWzFdLmNsYXNzTGlzdC50b2dnbGUoJ2ludmlzaWJsZScpO1xyXG59XHJcblxyXG5pZihidXJnZXJNZW51KSBidXJnZXJNZW51LmFkZEV2ZW50TGlzdGVuZXIoRXZlbnRzLkNMSUNLLCBtZW51QW5pbWF0aW9uKTsiXSwibmFtZXMiOltdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./src/scripts/ts/menu-animation.ts\n");

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
/******/ 	var __webpack_exports__ = __webpack_require__("./src/scripts/ts/menu-animation.ts");
/******/ 	
/******/ })()
;