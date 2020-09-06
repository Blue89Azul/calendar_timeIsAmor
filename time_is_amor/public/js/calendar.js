/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/calendar.js":
/*!**********************************!*\
  !*** ./resources/js/calendar.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  // アカウント一覧表示・非表示
  $(".option-btn__acount").on("click", function () {
    $(".profile").addClass("open-profile");
  });
  $(".btn__close").on("click", function () {
    $(".profile").removeClass("open-profile");
  }); //予定入力 ⇄ コメント・レビュー入力　スイッチャー機能

  $(".change-btn").on("click", function () {
    $(this).toggleClass("active");
    var flg = $(this).hasClass("active");

    if (flg == true) {
      $("#add-plan").css("display", "none");
      $("#done-for-us").css("display", "block");
      $(".change-btn-label").html("DONE FOR US");
      $(".color-and-like-btn").html("いいね！追加");
      $("#like").css("display", "block");
      $("#color").css("display", "none");
      $(".coment").prop("disabled", false);
      $(".add-plan").prop("disabled", true);
    } else {
      $("#add-plan").css("display", "block");
      $("#done-for-us").css("display", "none");
      $(".change-btn-label").html("ADD PLAN");
      $(".color-and-like-btn").html("色変更");
      $("#like").css("display", "none");
      $("#color").css("display", "block");
      $(".coment").prop("disabled", true);
      $(".add-plan").prop("disabled", false);
    }
  }); //フォームの送信先（action）切り替え

  $("#submit").on("click", function () {
    if ($(".change-btn").hasClass("active")) {
      $(this).parents('.plan-form').attr("action", $(this).data("action"));
      $(this).parents('.plan-form').submit();
    }
  }); // 今月の一枚：モーダル表示

  $("body").append('<div class="gray-layer"></div><div class="over-layer"></div>');
  $(".gray-layer").click(function () {
    $(".gray-layer, .over-layer").hide();
  });
  $("a.modal-img").click(function () {
    $(".gray-layer").show();
    $(".over-layer").show().html("<img src='" + $(this).attr("href") + "'>");
    return false;
  });
});

/***/ }),

/***/ 1:
/*!****************************************!*\
  !*** multi ./resources/js/calendar.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/azul/workspace/github/calendar_app/time_is_amor/resources/js/calendar.js */"./resources/js/calendar.js");


/***/ })

/******/ });