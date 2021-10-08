/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/scripts/main.js":
/*!*****************************!*\
  !*** ./src/scripts/main.js ***!
  \*****************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/web.dom-collections.for-each.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());


(function () {
  if (true) {
    console.log('Build that theme! Your JS goes here!', 'padding:0.5em 1em;');
  }
})();

(function ($) {
  // Primary Navigation
  var navToggle = document.getElementById("js-nav-toggle");
  var navWrapper = document.getElementById("ut-main_menu-wrapper");
  navToggle.addEventListener("click", function () {
    navWrapper.classList.toggle("active");
  }); // Primary Navigation - mobile

  var subNavIcon = document.querySelectorAll('.subnav-trigger');
  subNavIcon.forEach(function (icon) {
    icon.addEventListener("click", function () {
      icon.classList.toggle("icon--open");
      icon.nextElementSibling.classList.toggle("open");
    });
  }); // Alert Banner

  var AlertBanner = document.getElementById("alert-banner");

  if (!AlertBanner) {
    return;
  } else {
    announcementBar();
  }

  function announcementBar() {
    var closeBanner = document.getElementById("alert-banner__close-btn");
    var bannerText = document.getElementById("alert-banner__text").textContent;

    if (localStorage.getItem("ut-banner-data") != bannerText) {
      // If different, reset hide bar value for local storage.
      localStorage.setItem("ut-banner", "false");
    }

    if (localStorage.getItem("ut-banner") == "true") {
      // If false, remove the bar container.
      AlertBanner.remove();
    } else {
      // If true, remove hide class.
      AlertBanner.classList.remove("d-none");
    }

    closeBanner.addEventListener("click", function () {
      AlertBanner.remove();
      localStorage.setItem("ut-banner-data", bannerText);
      localStorage.setItem("ut-banner", "true");
    });
  } // Accordions


  var panels = document.querySelectorAll(".panel");
  panels.forEach(function (panel) {
    var heading = panel.querySelector(".panel-heading");
    heading.addEventListener("click", function () {
      heading.classList.toggle("panel-heading--open");
    });
  }); // Google Custom Search

  document.addEventListener('DOMContentLoaded', function () {
    var cx = '006470498568929423894:etsxpcor8wm';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol === 'https:' ? 'https:' : 'http:') + '//cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  });
})(jQuery);

/***/ }),

/***/ "./src/stylesheets/styles.scss":
/*!*************************************!*\
  !*** ./src/stylesheets/styles.scss ***!
  \*************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/icons/arrow-both.svg":
/*!**********************************!*\
  !*** ./src/icons/arrow-both.svg ***!
  \**********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
      id: "arrow-both-usage",
      viewBox: "0 0 10 14",
      url: __webpack_require__.p + "icons.svg#arrow-both",
      toString: function () {
        return this.url;
      }
    });

/***/ }),

/***/ "./src/icons/checkmark.svg":
/*!*********************************!*\
  !*** ./src/icons/checkmark.svg ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
      id: "checkmark-usage",
      viewBox: "0 0 216 146",
      url: __webpack_require__.p + "icons.svg#checkmark",
      toString: function () {
        return this.url;
      }
    });

/***/ }),

/***/ "./src/icons/symbol-defs.svg":
/*!***********************************!*\
  !*** ./src/icons/symbol-defs.svg ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
      id: "symbol-defs-usage",
      viewBox: undefined,
      url: __webpack_require__.p + "icons.svg#symbol-defs",
      toString: function () {
        return this.url;
      }
    });

/***/ }),

/***/ "./src/icons sync recursive ^\\.\\/.*$":
/*!**********************************!*\
  !*** ./src/icons/ sync ^\.\/.*$ ***!
  \**********************************/
/***/ (function(module, __unused_webpack_exports, __webpack_require__) {

var map = {
	"./arrow-both.svg": "./src/icons/arrow-both.svg",
	"./checkmark.svg": "./src/icons/checkmark.svg",
	"./symbol-defs.svg": "./src/icons/symbol-defs.svg"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "./src/icons sync recursive ^\\.\\/.*$";

/***/ }),

/***/ "./src/img/png sync recursive ^\\.\\/.*$":
/*!************************************!*\
  !*** ./src/img/png/ sync ^\.\/.*$ ***!
  \************************************/
/***/ (function(module) {

function webpackEmptyContext(req) {
	var e = new Error("Cannot find module '" + req + "'");
	e.code = 'MODULE_NOT_FOUND';
	throw e;
}
webpackEmptyContext.keys = function() { return []; };
webpackEmptyContext.resolve = webpackEmptyContext;
webpackEmptyContext.id = "./src/img/png sync recursive ^\\.\\/.*$";
module.exports = webpackEmptyContext;

/***/ }),

/***/ "./src/img/svg sync recursive ^\\.\\/.*$":
/*!************************************!*\
  !*** ./src/img/svg/ sync ^\.\/.*$ ***!
  \************************************/
/***/ (function(module) {

function webpackEmptyContext(req) {
	var e = new Error("Cannot find module '" + req + "'");
	e.code = 'MODULE_NOT_FOUND';
	throw e;
}
webpackEmptyContext.keys = function() { return []; };
webpackEmptyContext.resolve = webpackEmptyContext;
webpackEmptyContext.id = "./src/img/svg sync recursive ^\\.\\/.*$";
module.exports = webpackEmptyContext;

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
/******/ 	/* webpack/runtime/global */
/******/ 	!function() {
/******/ 		__webpack_require__.g = (function() {
/******/ 			if (typeof globalThis === 'object') return globalThis;
/******/ 			try {
/******/ 				return this || new Function('return this')();
/******/ 			} catch (e) {
/******/ 				if (typeof window === 'object') return window;
/******/ 			}
/******/ 		})();
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/publicPath */
/******/ 	!function() {
/******/ 		var scriptUrl;
/******/ 		if (__webpack_require__.g.importScripts) scriptUrl = __webpack_require__.g.location + "";
/******/ 		var document = __webpack_require__.g.document;
/******/ 		if (!scriptUrl && document) {
/******/ 			if (document.currentScript)
/******/ 				scriptUrl = document.currentScript.src
/******/ 			if (!scriptUrl) {
/******/ 				var scripts = document.getElementsByTagName("script");
/******/ 				if(scripts.length) scriptUrl = scripts[scripts.length - 1].src
/******/ 			}
/******/ 		}
/******/ 		// When supporting browsers where an automatic publicPath is not supported you must specify an output.publicPath manually via configuration
/******/ 		// or pass an empty string ("") and set the __webpack_public_path__ variable from your code to use your own logic.
/******/ 		if (!scriptUrl) throw new Error("Automatic publicPath is not supported in this browser");
/******/ 		scriptUrl = scriptUrl.replace(/#.*$/, "").replace(/\?.*$/, "").replace(/\/[^\/]+$/, "/");
/******/ 		__webpack_require__.p = scriptUrl;
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__(/*! stylesheets/styles.scss */ "./src/stylesheets/styles.scss");

__webpack_require__(/*! scripts/main */ "./src/scripts/main.js");

__webpack_require__("./src/img/svg sync recursive ^\\.\\/.*$");

__webpack_require__("./src/img/png sync recursive ^\\.\\/.*$");

__webpack_require__("./src/icons sync recursive ^\\.\\/.*$");
}();
/******/ })()
;
//# sourceMappingURL=main.js.map